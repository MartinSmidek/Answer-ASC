<?php
/**
 * Administrátorský editor existující přihlášky ASC.
 *
 * MVP fáze 1: pouze admin (db2 session). Edituje pobyty libovolné akce
 * (odeslané webem i ručně založené v admin aplikaci).
 *
 * Edituje pole:
 *   pobyt.pocet1..3   – počet účastníků na programu (pá/so/ne)
 *   pobyt.pocet4..5   – počet noclehů (pá/so)
 *   pobyt.web_json    – per-člen Xturnaj v JSON struktuře
 *
 * Vývoj v asc-test/, po ověření přesun do asc/.
 */

session_start();
error_reporting(0);
set_error_handler(function($s,$m,$f,$l){ throw new ErrorException($m,0,$s,$f,$l); });
set_exception_handler(function($e) {
  http_response_code(500);
  header('Content-Type: text/html; charset=utf-8');
  echo "<!doctype html><meta charset='utf-8'>"
     . "<h2>Chyba v edit_prihlaska.php</h2>"
     . "<p style='font-family:sans-serif;color:#900'>" . htmlspecialchars($e->getMessage()) . "</p>"
     . "<pre style='font-size:.85em;color:#444'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
});

$ezer_version= '3.3';
$_TEST= preg_match('/-test/', $_SERVER['SERVER_NAME'] ?? '') ? '_test' : '';
require_once __DIR__ . '/prihlaska.org.php';                  // → $ORG

# -------------------------------------------------------------------- 1. AUTH
# stejná logika jako v prihlaska_asc.4.php:103 — klíč závisí na $ORG->code a test/prod
$session_key= $_TEST ? ($ORG->code==32 ? 'asc' : 'dbt')
                     : ($ORG->code==32 ? 'asc' : 'db2');
$admin_user_id= (int)($_SESSION[$session_key]['user_id'] ?? 0);
if (!$admin_user_id) {
  http_response_code(403);
  exit('Přístup pouze pro administrátora.');
}
$admin_email= $_SESSION[$session_key]['email'] ?? '?';

# --------------------------------------------------------- 2. BOOTSTRAP DB + LIB
require_once __DIR__ . "/../files/{$ORG->deep}";              // → $abs_root, $rel_root, $dbs, $db, $ezer_server
chdir($abs_root);
$kernel= "ezer{$ezer_version}";
require_once __DIR__ . "/$kernel/server/ae_slib.php";
require_once __DIR__ . "/$kernel/pdo.inc.php";
require_once __DIR__ . "/$kernel/server/ezer_pdo.php";

global $ezer_db, $curr_db, $TEST, $totrace, $y;
$TEST= 0; $totrace= ''; $y= (object)[];
if (isset($dbs[$ezer_server])) {
  $dbs= $dbs[$ezer_server];
}
$ezer_db= $dbs;
ezer_connect();                                   // default: první DB z $ezer_db = ezer_asc[_test]

require_once __DIR__ . '/prihlaska_lib.php';

# ------------------------------------------------------------------- 3. STATE
$id_pobyt= (int)($_GET['id_pobyt'] ?? $_POST['id_pobyt'] ?? 0);
$pobyt= null;
$akce_info= null;
$cleni= [];
$web= null;

if ($id_pobyt > 0) {
  $pobyt= lib_obj(
    "SELECT id_pobyt, id_akce, pocet1, pocet2, pocet3, pocet4, pocet5,
            zadost, zadost2, web_json
     FROM pobyt WHERE id_pobyt=$id_pobyt");
  if ($pobyt) {
    $ida= (int)$pobyt->id_akce;
    $akce_info= lib_obj(
      "SELECT id_duakce AS id_akce, nazev, datum_od, datum_do
       FROM akce WHERE id_duakce=$ida");
    $rs= lib_q(
      "SELECT s.id_osoba AS ido, CONCAT(o.jmeno,' ',o.prijmeni) AS jmeno, s.s_role AS role
       FROM spolu s JOIN osoba o USING(id_osoba)
       WHERE s.id_pobyt=$id_pobyt
       ORDER BY s.id_spolu");
    while ($r= pdo_fetch_object($rs)) {
      $cleni[(int)$r->ido]= ['jmeno'=>$r->jmeno, 'role'=>$r->role];
    }
    $web= lib_json_decode($pobyt->web_json ?? '');
    if (!$web || !is_object($web)) $web= (object)[];
    // cleni může být object (z JSON object) nebo array (z JSON array, prázdné []), normalizujeme
    $web_cleni= [];
    if (isset($web->cleni)) {
      foreach ((array)$web->cleni as $k => $v) {
        $web_cleni[(int)$k]= is_object($v) ? $v : (object)$v;
      }
    }
  }
}

# --------------------------------------------------------------- 4. CSRF + flash
if (!isset($_SESSION['edit_prihlaska_csrf'])) {
  $_SESSION['edit_prihlaska_csrf']= bin2hex(random_bytes(16));
}
$csrf= $_SESSION['edit_prihlaska_csrf'];
$flash= $_SESSION['edit_prihlaska_flash'] ?? '';
unset($_SESSION['edit_prihlaska_flash']);

# ----------------------------------------------------------------- 5. POST: DELETE rozpracované
$method= $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'POST' && ($_POST['action'] ?? '') === 'delete_prihlaska') {
  if (($_POST['csrf'] ?? '') !== $csrf) {
    http_response_code(403);
    exit('Neplatný CSRF token.');
  }
  $idw= (int)($_POST['id_prihlaska'] ?? 0);
  if ($idw <= 0) { http_response_code(400); exit('Chybí id_prihlaska.'); }
  $row= lib_obj("SELECT id_pobyt, id_akce, email FROM prihlaska WHERE id_prihlaska=$idw");
  if (!$row) { http_response_code(404); exit("Přihláška id=$idw nenalezena."); }
  if ((int)$row->id_pobyt !== 0) {
    http_response_code(400);
    exit('Přihláška je již odeslaná (má pobyt) — mazání povoleno jen pro rozpracované.');
  }
  // smaž
  lib_exec("DELETE FROM prihlaska WHERE id_prihlaska=$idw");
  // audit
  $msg= "<b style='color:red'>DELETE</b> ... rozpracovaná id_prihlaska=$idw email=" . ($row->email ?? '')
      . " admin user=$admin_user_id";
  lib_audit_append((int)$row->id_akce, $msg, $admin_email);
  $_SESSION['edit_prihlaska_flash']= "Rozpracovaná přihláška #$idw byla smazána.";
  $qredir=    trim((string)($_POST['q']    ?? ''));
  $stavredir= (string)      ($_POST['stav'] ?? '');
  $params= [];
  if ($qredir !== '')    $params[]= 'q='    . urlencode($qredir);
  if ($stavredir !== '') $params[]= 'stav=' . urlencode($stavredir);
  // pokud admin přišel z search se stav=rozpracovane, zachováme to → znovu vidí seznam pro další mazání
  if (!$params) $params[]= 'stav=rozpracovane';
  header('Location: ' . basename(__FILE__) . '?' . implode('&', $params));
  exit;
}

# ----------------------------------------------------------------- 5b. POST: SAVE
if ($method === 'POST' && ($_POST['action'] ?? '') === 'save') {
  if (($_POST['csrf'] ?? '') !== $csrf) {
    http_response_code(403);
    exit('Neplatný CSRF token, pravděpodobně vypršela platnost formuláře. Vraťte se a opakujte úpravu.');
  }
  if (!$pobyt) {
    http_response_code(400);
    exit("Pobyt id=$id_pobyt nenalezen.");
  }

  // pocet1..5: int, jen neZáporné
  $sets= [];
  $new_pocet= [];
  for ($i=1; $i<=5; $i++) {
    $v= (int)($_POST["pocet$i"] ?? 0);
    if ($v < 0) $v= 0;
    $new_pocet[$i]= $v;
    $sets[]= "pocet{$i}=$v";
  }
  // zadost / zadost2: 0/1
  $new_zadost=  isset($_POST['zadost'])  ? 1 : 0;
  $new_zadost2= isset($_POST['zadost2']) ? 1 : 0;
  $sets[]= "zadost=$new_zadost";
  $sets[]= "zadost2=$new_zadost2";

  // web_json: pro každého člena ze spolu nastav Xturnaj; ostatní klíče zachovej
  $turnaj_in= $_POST['turnaj'] ?? [];
  if (!is_array($turnaj_in)) $turnaj_in= [];
  foreach ($cleni as $ido => $_info) {
    if (!isset($web_cleni[$ido])) $web_cleni[$ido]= (object)[];
    $web_cleni[$ido]->Xturnaj= isset($turnaj_in[$ido]) || isset($turnaj_in[(string)$ido]);
  }
  // rekonstrukce web->cleni jako stdClass se string klíči (aby JSON byl object, ne array)
  $cleni_out= (object)[];
  foreach ($web_cleni as $k => $v) { $cleni_out->{(string)$k}= $v; }
  $web->cleni= $cleni_out;
  $new_json= lib_json_encode($web);
  $sets[]= "web_json='" . lib_esc($new_json) . "'";

  // diff pro audit
  $diff= [];
  for ($i=1; $i<=5; $i++) {
    $old= (int)$pobyt->{"pocet$i"};
    if ($old !== $new_pocet[$i]) $diff[]= "pocet$i:{$old}→{$new_pocet[$i]}";
  }
  $oz=  (int)($pobyt->zadost  ?? 0);  if ($oz  !== $new_zadost)  $diff[]= "zadost:{$oz}→{$new_zadost}";
  $oz2= (int)($pobyt->zadost2 ?? 0);  if ($oz2 !== $new_zadost2) $diff[]= "zadost2:{$oz2}→{$new_zadost2}";
  if (($pobyt->web_json ?? '') !== $new_json) $diff[]= 'web_json změněn';

  // _track audit — strukturovaný záznam každé změny jednoduchých polí pobytu.
  // JSON pole (web_json) sem nezapisujeme — konzistentní s hlavním formulářem,
  // textový audit JSONových změn je v prihlaska.log.php přes lib_audit_append.
  $kdo_track= "EDIT-ADMIN/$admin_user_id";
  for ($i=1; $i<=5; $i++) {
    $old= (int)$pobyt->{"pocet$i"};
    if ($old !== $new_pocet[$i]) {
      lib_track_change('pobyt', $id_pobyt, "pocet$i", $old, $new_pocet[$i], $kdo_track);
    }
  }
  if ($oz  !== $new_zadost)  lib_track_change('pobyt', $id_pobyt, 'zadost',  $oz,  $new_zadost,  $kdo_track);
  if ($oz2 !== $new_zadost2) lib_track_change('pobyt', $id_pobyt, 'zadost2', $oz2, $new_zadost2, $kdo_track);

  $sql= "UPDATE pobyt SET " . implode(', ', $sets) . " WHERE id_pobyt=$id_pobyt";
  lib_exec($sql);

  // synchronizace prihlaska.vars_json — odsud čte report Xturnaj (db-tisk.php:1030)
  $rs_pr= lib_q("SELECT id_prihlaska, vars_json FROM prihlaska WHERE id_pobyt=$id_pobyt");
  $existing_pr= [];
  while ($pr= pdo_fetch_object($rs_pr)) { $existing_pr[]= $pr; }

  // pomocná funkce: do předaného vars_json (nebo prázdného) zapíše Xturnaj per člen
  // a zachová ostatní existující data; vrátí JSON string
  $build_vars_json= function($old_json) use ($cleni, $turnaj_in) {
    $vj= lib_json_decode($old_json ?? '');
    if (!$vj || !is_object($vj)) $vj= (object)[];
    $vj_cleni= [];
    if (isset($vj->cleni)) {
      foreach ((array)$vj->cleni as $k => $v) {
        $vj_cleni[(int)$k]= is_object($v) ? $v : (object)$v;
      }
    }
    foreach ($cleni as $ido => $_info) {
      if (!isset($vj_cleni[$ido])) $vj_cleni[$ido]= (object)[];
      $vj_cleni[$ido]->Xturnaj= isset($turnaj_in[$ido]) || isset($turnaj_in[(string)$ido]);
    }
    $vj_cleni_out= (object)[];
    foreach ($vj_cleni as $k => $v) { $vj_cleni_out->{(string)$k}= $v; }
    $vj->cleni= $vj_cleni_out;
    return lib_json_encode($vj);
  };

  if (count($existing_pr) > 0) {
    // existující prihlasky — aktualizuj všechny (typicky 1, ale web flow může mít víc)
    $vars_synced= 0;
    foreach ($existing_pr as $pr) {
      $new_vj= $build_vars_json($pr->vars_json);
      lib_exec("UPDATE prihlaska SET save=NOW(), vars_json='" . lib_esc($new_vj) . "'"
             . " WHERE id_prihlaska={$pr->id_prihlaska}");
      $vars_synced++;
    }
    $diff[]= "prihlaska.vars_json synced ({$vars_synced}×)";
  }
  else {
    // ručně založený pobyt bez prihlasky → vytvoř stub
    $stub_vj= $build_vars_json('');
    $stub_id= lib_prihlaska_stub_create((int)$pobyt->id_akce, $id_pobyt, $stub_vj);
    if ($stub_id > 0) {
      $diff[]= "prihlaska stub vytvořen (id_prihlaska=$stub_id)";
    }
  }

  $msg= "<b style='color:orange'>EDIT</b> ... id_pobyt=$id_pobyt admin user=$admin_user_id změny: "
      . (count($diff) ? implode(', ', $diff) : 'žádné');
  lib_audit_append((int)$pobyt->id_akce, $msg, $admin_email);

  $_SESSION['edit_prihlaska_flash']= 'Změny byly uloženy' . (count($diff) ? '.' : ' (žádné rozdíly).');
  header('Location: ' . basename(__FILE__) . "?id_pobyt=$id_pobyt");
  exit;
}

# --------------------------------------------------------- 6. GET: výběr akce + vyhledávač
# výběr akce — z URL parametru (přepisuje session) nebo ze session
if (isset($_GET['id_akce'])) {
  $sel_akce= (int)$_GET['id_akce'];
  if ($sel_akce > 0) $_SESSION['edit_prihlaska_id_akce']= $sel_akce;
  else unset($_SESSION['edit_prihlaska_id_akce']);
}
$sel_akce= (int)($_SESSION['edit_prihlaska_id_akce'] ?? 0);

# pokud editujeme konkrétní pobyt, automaticky přepneme akci na jeho
if ($pobyt && (int)$pobyt->id_akce !== $sel_akce) {
  $sel_akce= (int)$pobyt->id_akce;
  $_SESSION['edit_prihlaska_id_akce']= $sel_akce;
}

# seznam akcí pro dropdown — jen ty s online přihlášením, řazeno datum_od DESC
$akce_list= [];
$rs= lib_q(
  "SELECT id_duakce AS id_akce, nazev, datum_od
   FROM akce
   WHERE web_online IS NOT NULL AND web_online!=''
   ORDER BY datum_od DESC
   LIMIT 50");
while ($r= pdo_fetch_object($rs)) { $akce_list[]= $r; }

$sel_akce_info= null;
if ($sel_akce) {
  foreach ($akce_list as $a) {
    if ((int)$a->id_akce === $sel_akce) { $sel_akce_info= $a; break; }
  }
  if (!$sel_akce_info) {
    // pobyt je z akce mimo dropdown (např. starší / bez web_online) — doplníme info zvlášť
    $sel_akce_info= lib_obj(
      "SELECT id_duakce AS id_akce, nazev, datum_od FROM akce WHERE id_duakce=$sel_akce");
  }
}

$search_results= [];     // odeslané pobyty (typ 'pobyt')
$unfinished_results= []; // rozpracované přihlášky bez pobytu (typ 'unfinished')
$q= trim((string)($_GET['q'] ?? ''));
$stav= (string)($_GET['stav'] ?? 'all');
if (!in_array($stav, ['all','odeslane','rozpracovane'], true)) $stav= 'all';

# spustit search pokud admin form odeslal (i s prázdným q) nebo má parametr stav
$search_submitted= isset($_GET['q']) || isset($_GET['stav']);

if (!$id_pobyt && $sel_akce > 0 && $search_submitted) {
  $qe= lib_esc($q);
  $q_num= ($q !== '' && ctype_digit($q)) ? (int)$q : 0;
  $has_q= ($q !== '');

  // 1) odeslané pobyty
  if ($stav !== 'rozpracovane') {
    $cond_q= '';
    if ($has_q) {
      $cond_q= " AND (o.jmeno LIKE '%$qe%'
                  OR o.prijmeni LIKE '%$qe%'
                  OR o.email LIKE '%$qe%'
                  OR p.id_pobyt IN (SELECT id_pobyt FROM prihlaska WHERE email LIKE '%$qe%')";
      if ($q_num > 0) $cond_q.= " OR p.id_pobyt=$q_num";
      $cond_q.= ")";
    }
    $rs= lib_q(
      "SELECT p.id_pobyt, p.id_akce, a.nazev AS akce_nazev, a.datum_od,
              GROUP_CONCAT(CONCAT(o.jmeno,' ',o.prijmeni) SEPARATOR ', ') AS jmena,
              GROUP_CONCAT(DISTINCT NULLIF(o.email,'') SEPARATOR ', ') AS emaily
       FROM pobyt p
       LEFT JOIN akce a ON a.id_duakce=p.id_akce
       LEFT JOIN spolu s ON s.id_pobyt=p.id_pobyt
       LEFT JOIN osoba o ON o.id_osoba=s.id_osoba
       WHERE p.id_akce=$sel_akce $cond_q
       GROUP BY p.id_pobyt, p.id_akce, a.nazev, a.datum_od
       ORDER BY p.id_pobyt DESC
       LIMIT 100");
    while ($r= pdo_fetch_object($rs)) { $search_results[]= $r; }
  }

  // 2) rozpracované přihlášky (id_pobyt=0)
  if ($stav !== 'odeslane') {
    $cond_q2= '';
    if ($has_q) {
      $cond_q2= " AND (pr.email LIKE '%$qe%'
                   OR o.jmeno LIKE '%$qe%'
                   OR o.prijmeni LIKE '%$qe%'";
      if ($q_num > 0) $cond_q2.= " OR pr.id_prihlaska=$q_num";
      $cond_q2.= ")";
    }
    $rs2= lib_q(
      "SELECT pr.id_prihlaska, pr.email, pr.open, pr.save, pr.stav,
              CONCAT_WS(' ', o.jmeno, o.prijmeni) AS klient_jmeno
       FROM prihlaska pr
       LEFT JOIN osoba o ON o.id_osoba=pr.id_osoba
       WHERE pr.id_akce=$sel_akce AND pr.id_pobyt=0 $cond_q2
       ORDER BY pr.id_prihlaska DESC
       LIMIT 100");
    while ($r= pdo_fetch_object($rs2)) { $unfinished_results[]= $r; }
  }
}

# ------------------------------------------------------------------ 7. RENDER
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>Úprava přihlášky ASC <?= $id_pobyt ? "#$id_pobyt" : '' ?></title>
<style>
  body { font-family: sans-serif; max-width: 760px; margin: 2em auto; padding: 0 1em; color:#222; }
  h1, h2 { color: #336; }
  h1 { margin-bottom: .2em; }
  .meta { color: #666; font-size: .9em; }
  .flash { background: #dfd; padding: .6em 1em; border-radius: 4px; margin: 1em 0; border:1px solid #9c9; }
  .nothing { color:#888; font-style:italic; }
  form.search { margin: 1em 0; display:flex; gap:.5em; }
  form.search input[type=text] { flex:1; padding:.4em; }
  table.search { border-collapse: collapse; width: 100%; margin: 1em 0; font-size:.95em; }
  table.search th, table.search td { border: 1px solid #ccc; padding: .35em .6em; text-align: left; vertical-align: top; }
  table.search th { background:#f4f4f4; }
  table.search a { text-decoration: none; color:#36a; }
  fieldset { margin: 1em 0; border:1px solid #bbb; padding:.8em 1em; }
  fieldset legend { font-weight:bold; padding:0 .4em; }
  .pocty { display: grid; grid-template-columns: repeat(3, 1fr); gap: .5em; max-width:520px; }
  .pocty.dva { grid-template-columns: repeat(2, 1fr); }
  .pocty label { display: block; }
  .pocty input { width: 4em; }
  .clen { padding: .25em 0; }
  button { padding: .55em 1.4em; font-size: 1em; cursor:pointer; }
  button.danger { background:#fee; border:1px solid #c66; color:#900; padding:.3em .8em; font-size:.9em; }
  button.danger:hover { background:#fcc; }
  .badge { display:inline-block; padding:.1em .5em; border-radius:3px; font-size:.85em; white-space:nowrap; }
  .badge.ok { background:#dfd; color:#262; border:1px solid #9c9; }
  .badge.unfin { background:#ffd; color:#660; border:1px solid #cc6; }
  tr.row-unfinished td { background:#fffbe8; }
  .actions { margin-top: 1em; display:flex; gap:1em; align-items:center; }
  .actions a { color:#888; }
</style>
</head>
<body>

<h1>Úprava přihlášky <?= $id_pobyt ? "#{$id_pobyt}" : '' ?></h1>
<p class="meta">
  Admin: user=<?= h($admin_user_id) ?> (<?= h($admin_email) ?>)
  <?php if ($akce_info): ?>
    · Akce: <b><?= h($akce_info->nazev) ?></b> (<?= h($akce_info->datum_od) ?>)
  <?php endif ?>
</p>

<?php if ($flash): ?>
  <div class="flash"><?= h($flash) ?></div>
<?php endif ?>

<?php if (!$id_pobyt): ?>
  <h2>Vyhledat přihlášku</h2>
  <form class="search" method="get" style="margin-bottom:.4em">
    <label style="display:flex;align-items:center;gap:.4em;flex:1">
      Akce:
      <select name="id_akce" onchange="this.form.submit()" style="flex:1;padding:.4em">
        <option value="0">— vyberte akci —</option>
        <?php foreach ($akce_list as $a): ?>
          <option value="<?= (int)$a->id_akce ?>" <?= ((int)$a->id_akce===$sel_akce)?'selected':'' ?>>
            <?= h($a->nazev) ?> (<?= h($a->datum_od) ?>)
          </option>
        <?php endforeach ?>
      </select>
    </label>
  </form>
  <?php if ($sel_akce > 0): ?>
    <form class="search" method="get">
      <input type="hidden" name="id_akce" value="<?= $sel_akce ?>">
      <input type="text" name="q" value="<?= h($q) ?>" placeholder="jméno, email, id_pobyt — prázdné = vše" autofocus style="flex:2">
      <select name="stav" style="padding:.4em">
        <option value="all"           <?= $stav==='all'           ? 'selected':'' ?>>vše</option>
        <option value="odeslane"      <?= $stav==='odeslane'      ? 'selected':'' ?>>jen odeslané</option>
        <option value="rozpracovane"  <?= $stav==='rozpracovane'  ? 'selected':'' ?>>jen rozpracované</option>
      </select>
      <button>Hledat</button>
    </form>
  <?php else: ?>
    <p class="meta">Nejdřív vyberte akci, pak budete moci vyhledávat přihlášky.</p>
  <?php endif ?>
  <?php if ($sel_akce > 0 && $search_submitted): ?>
    <?php if (!$search_results && !$unfinished_results): ?>
      <p class="nothing">
        <?php if ($q !== ''): ?>
          Žádné výsledky pro „<?= h($q) ?>“ v této akci.
        <?php else: ?>
          <?= $stav==='rozpracovane' ? 'Žádné rozpracované přihlášky' : ($stav==='odeslane' ? 'Žádné odeslané přihlášky' : 'Žádné přihlášky') ?> v této akci.
        <?php endif ?>
      </p>
    <?php else: ?>
      <table class="search">
        <tr><th>stav</th><th>id</th><th>email / klient</th><th>info</th><th></th></tr>
        <?php foreach ($search_results as $r): ?>
          <tr>
            <td><span class="badge ok">odeslaná</span></td>
            <td>pobyt #<?= (int)$r->id_pobyt ?></td>
            <td><?= h($r->emaily ?? '') ?></td>
            <td><?= h($r->jmena ?? '') ?></td>
            <td><a href="?id_pobyt=<?= (int)$r->id_pobyt ?>">upravit →</a></td>
          </tr>
        <?php endforeach ?>
        <?php foreach ($unfinished_results as $r): ?>
          <tr class="row-unfinished">
            <td><span class="badge unfin">rozpracovaná</span></td>
            <td>přihl. #<?= (int)$r->id_prihlaska ?></td>
            <td><?= h($r->email ?? '') ?></td>
            <td>
              <?= h($r->klient_jmeno ?: '(klient neidentifikován)') ?>
              <span class="meta">otevř. <?= h($r->open ?? '') ?>
                <?= $r->save ? ' · sav. ' . h($r->save) : '' ?>
                <?= $r->stav ? ' · ' . h($r->stav) : '' ?>
              </span>
            </td>
            <td>
              <form method="post" style="display:inline;margin:0"
                    onsubmit="return confirm('Smazat rozpracovanou přihlášku #<?= (int)$r->id_prihlaska ?>?\nTuto akci nelze vrátit zpět.')">
                <input type="hidden" name="action" value="delete_prihlaska">
                <input type="hidden" name="csrf" value="<?= h($csrf) ?>">
                <input type="hidden" name="id_prihlaska" value="<?= (int)$r->id_prihlaska ?>">
                <input type="hidden" name="q" value="<?= h($q) ?>">
                <input type="hidden" name="stav" value="<?= h($stav) ?>">
                <button type="submit" class="danger">smazat</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </table>
    <?php endif ?>
  <?php elseif ($sel_akce > 0): ?>
    <p class="meta">
      Klikni na <b>Hledat</b> (s prázdným polem zobrazíš všechny přihlášky vybrané akce).
      Filtrem <i>jen rozpracované</i> rychle najdeš přihlášky k odmazání.
      Nebo otevři přímo konkrétní pobyt přes <code>?id_pobyt=N</code>.
    </p>
  <?php endif ?>

<?php elseif (!$pobyt): ?>
  <p>Pobyt s id <?= (int)$id_pobyt ?> nebyl nalezen.</p>
  <p><a href="<?= h(basename(__FILE__)) ?>">← zpět na vyhledávání</a></p>

<?php else: ?>
  <form method="post">
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="csrf" value="<?= h($csrf) ?>">
    <input type="hidden" name="id_pobyt" value="<?= (int)$id_pobyt ?>">

    <fieldset>
      <legend>Počet účastníků na programu</legend>
      <div class="pocty">
        <label>Pátek<br><input type="number" min="0" name="pocet1" value="<?= (int)$pobyt->pocet1 ?>"></label>
        <label>Sobota<br><input type="number" min="0" name="pocet2" value="<?= (int)$pobyt->pocet2 ?>"></label>
        <label>Neděle<br><input type="number" min="0" name="pocet3" value="<?= (int)$pobyt->pocet3 ?>"></label>
      </div>
    </fieldset>

    <fieldset>
      <legend>Žádost / požadavky</legend>
      <div class="clen">
        <label>
          <input type="checkbox" name="zadost" value="1" <?= ((int)($pobyt->zadost ?? 0) ? 'checked' : '') ?>>
          Žádost 1 (např. nocleh v Praze — má vliv na pocet4 / pocet5)
        </label>
      </div>
      <div class="clen">
        <label>
          <input type="checkbox" name="zadost2" value="1" <?= ((int)($pobyt->zadost2 ?? 0) ? 'checked' : '') ?>>
          Žádost 2
        </label>
      </div>
    </fieldset>

    <fieldset>
      <legend>Počet noclehů</legend>
      <div class="pocty dva">
        <label>Pátek<br><input type="number" min="0" name="pocet4" value="<?= (int)$pobyt->pocet4 ?>"></label>
        <label>Sobota<br><input type="number" min="0" name="pocet5" value="<?= (int)$pobyt->pocet5 ?>"></label>
      </div>
    </fieldset>

    <fieldset>
      <legend>Účast na turnaji (per člen)</legend>
      <?php if (!$cleni): ?>
        <p class="nothing">U této přihlášky nejsou ve <code>spolu</code> evidováni žádní členové.</p>
      <?php else: foreach ($cleni as $ido => $info):
        $checked= (isset($web_cleni[$ido]->Xturnaj) && $web_cleni[$ido]->Xturnaj) ? 'checked' : '';
      ?>
        <div class="clen">
          <label>
            <input type="checkbox" name="turnaj[<?= (int)$ido ?>]" value="1" <?= $checked ?>>
            <?= h($info['jmeno']) ?>
            <span class="meta">(id_osoba=<?= (int)$ido ?><?= $info['role'] ? ", role=" . h($info['role']) : '' ?>)</span>
          </label>
        </div>
      <?php endforeach; endif ?>
    </fieldset>

    <div class="actions">
      <button type="submit">Uložit změny</button>
      <a href="<?= h(basename(__FILE__)) ?>">← vyhledávač</a>
    </div>
  </form>
<?php endif ?>

</body>
</html>
