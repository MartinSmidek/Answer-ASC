<?php
/**
 * Sdílená knihovna pro online přihlášky ASC.
 *
 * Tenké utility nad kernel funkcemi z ezer3.3/server/ezer_pdo.php
 * (pdo_query, pdo_fetch_row, pdo_fetch_object, pdo_real_escape_string).
 *
 * Předpoklad: před voláním kterékoli funkce již proběhl bootstrap DB
 * (kernel + ezer_connect()). Knihovna sama nic neinicializuje.
 *
 * Konvence: prefix `lib_` aby nedošlo ke kolizi s pdo_query_2/select_2/append_log
 * v prihlaska_asc.4.php.
 */

# ---------------------------------------------------------- DB wrappery
function lib_q($sql) { // ----------- univerzální spuštění SQL, vyhodí výjimku při chybě
# pro SELECT vrací PDOStatement, pro INSERT/UPDATE/DELETE vrací počet řádků
  global $ezer_db, $curr_db;
  $res= pdo_query($sql, 1); // quiet=1, chybu zpracujeme sami
  if ($res === false) {
    $pdo= $ezer_db[$curr_db][0];
    $msg= $pdo ? ($pdo->errorInfo()[2] ?? '?') : '?';
    throw new RuntimeException("SQL chyba: $msg | " . substr($sql, 0, 200));
  }
  return $res;
}
function lib_row($sql) { // ------------------------- vrátí jeden řádek jako numerické pole, nebo null
  $res= lib_q($sql);
  $row= pdo_fetch_row($res);
  return $row ?: null;
}
function lib_obj($sql) { // ------------------------------------------ vrátí jeden řádek jako objekt
  $res= lib_q($sql);
  $obj= pdo_fetch_object($res);
  return $obj ?: null;
}
function lib_val($sql) { // ---------------------------------- vrátí první sloupec prvního řádku, '' jinak
  $row= lib_row($sql);
  return $row ? ($row[0] ?? '') : '';
}
function lib_exec($sql) { // -------- spustí INSERT/UPDATE/DELETE, vrátí počet ovlivněných řádků (int)
  return (int)lib_q($sql);
}
function lib_esc($s) { // --------------------------- escape pro vložení do SQL stringu (mezi apostrofy)
  return pdo_real_escape_string($s);
}

# ---------------------------------------------------------- JSON wrappery
function lib_json_encode($x) { // -------------------- konzistentní encoding (UTF-8 bez escape)
  return json_encode($x, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
function lib_json_decode($s) { // ------------------------- dekóduje na stdClass; '' / chyba → null
  if ($s === '' || $s === null) return null;
  $r= json_decode($s);
  return (json_last_error() === JSON_ERROR_NONE) ? $r : null;
}

# ---------------------------------------------------------- prihlaska stub
function lib_prihlaska_stub_create($id_akce, $id_pobyt, $vars_json) { // ---------- stub pro ručně založené pobyty
# Vytvoří minimální záznam v `prihlaska`, aby reporty čtoucí prihlaska.vars_json
# (např. db-tisk.php Xturnaj) viděly hodnoty zadané administrátorem v editoru.
# Voláno při editaci pobytu, pro který neexistuje žádný prihlaska záznam
# (typicky pobyty založené ručně v admin aplikaci, ne přes web).
# Identifikační příznaky:
#   verze='asc.4-stub'  — odlišení od reálných web přihlášek
#   stav='STUB-EDIT'    — viditelné v admin přehledech
# Vrací id_prihlaska nově vytvořeného záznamu, nebo 0 při selhání.
  $id_akce=  (int)$id_akce;
  $id_pobyt= (int)$id_pobyt;
  $vj_esc= lib_esc($vars_json);
  lib_exec(
    "INSERT INTO prihlaska SET "
    . "verze='asc.4-stub',"
    . "open=NOW(),"
    . "save=NOW(),"
    . "id_akce=$id_akce,"
    . "id_pobyt=$id_pobyt,"
    . "email='',"
    . "stav='STUB-EDIT',"
    . "vars_json='$vj_esc'");
  $idw= (int)pdo_insert_id();
  if ($idw > 0) {
    // _track záznam — analogicky log_open() v prihlaska_asc.4.php:2933
    lib_exec(
      "INSERT INTO _track (kdy,kdo,kde,klic,op,fld,val) "
      . "VALUES (NOW(),'EDIT-ADMIN','prihlaska',$idw,'i','id_akce',$id_akce)");
  }
  return $idw;
}

# ---------------------------------------------------------- _track audit
function lib_track_change($kde, $klic, $fld, $old, $val, $kdo='EDIT-ADMIN') { // ---- zápis do _track
# Strukturovaný audit změny do tabulky _track — stejný formát, jaký používá
# query_track_2 v prihlaska_asc.4.php a admin app db2/*.
# Sloupce _track: kdy, kdo, kde, klic, fld, op, old, val
#   kde   – název tabulky ('pobyt', 'prihlaska', 'osoba', …)
#   klic  – id záznamu (int)
#   fld   – název sloupce, který se změnil
#   op    – 'u' (update), 'i' (init při INSERT)
  $klic= (int)$klic;
  $kdo_e= lib_esc($kdo);
  $kde_e= lib_esc($kde);
  $fld_e= lib_esc($fld);
  $old_e= lib_esc((string)$old);
  $val_e= lib_esc((string)$val);
  lib_exec(
    "INSERT INTO _track (kdy,kdo,kde,klic,fld,op,old,val) "
    . "VALUES (NOW(),'$kdo_e','$kde_e',$klic,'$fld_e','u','$old_e','$val_e')");
}

# ---------------------------------------------------------- audit log
function lib_audit_append($id_akce, $msg, $email='?') { // -- připíše řádek do prihlaska.log.php
# formát kompatibilní s append_log() v prihlaska_asc.4.php:3101
# log soubor zakládá hlavní formulář; pokud neexistuje, knihovna ho NEzakládá
  $file= 'prihlaska.log.php';
  if (!file_exists($file)) return;
  $ip=  $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '?';
  $ida= str_pad((string)$id_akce, 4, ' ', STR_PAD_LEFT);
  $line= "asc.4-edit  $ida " . date('Y-m-d H:i:s') . "    ? $msg mail=$email ip=$ip\n";
  file_put_contents($file, $line, FILE_APPEND);
}
