<?php 
  session_start(); 
  if(!($_SESSION['ast']['user_id']??0) && !($_SESSION['db2']['user_id']??0) && !($_SESSION['dbt']['user_id']??0) && !isset($_GET['itsme'])) exit; 
?>
<html><head><title>přihlášky</title>
<link rel="shortcut icon" href="img/log_icon.png">
<script src="/ezer3.3/client/licensed/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="prihlaska_2025.4.js?corr=1" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">window.addEventListener('load', function() { pretty_log();});</script>  
</script>
</head><body><pre id="log"
><b>VERZE/JS  AKCE DATUM      ČAS      PŘIHLÁŠKA       KLIENT </b>
2025.4/1     3 2025-10-22 17:17:37    9 DOTAZ= ... už je přihlášen Martin Šmídek  mail=martin@smidek.eu ip=127.0.0.1
2025.4/1    3 2025-10-22 17:18:51    9 DOTAZ= ... už je přihlášen Martin Šmídek  mail=martin@smidek.eu ip=127.0.0.1
2025.4/1    3 2025-10-22 18:10:28   10 <b style='color:blue'>REGIST</b> ... x.y@seznam.cz mail=x.y@seznam.cz ip=127.0.0.1
2025.4/1    1 2025-10-22 18:11:11   11 <b style='color:blue'>REGIST</b> ... x.y@seznam.cz mail=x.y@seznam.cz ip=127.0.0.1
2025.4/1    1 2025-10-22 18:20:22   12 KLIENT ... Ondřej Lednický id_osoba=2, id_rodina=1 mail=ondra.lednicky@volny.cz ip=127.0.0.1
2025.4/1    1 2025-10-22 18:20:49   12 <b style='color:green'>POBYT </b> ... Ondřej Lednický id_pobyt=6 mail=ondra.lednicky@volny.cz ip=127.0.0.1
2025.4/1    1 2025-10-24 14:05:22    7 DOTAZ= ... už je přihlášen Martin Šmídek  mail=martin@smidek.eu ip=127.0.0.1
2025.4/1    1 2025-10-24 14:09:19   13 KLIENT ... Martin Šmídek id_osoba=6, id_rodina=2 mail=martin@smidek.eu ip=127.0.0.1
2025.4/1    1 2025-12-18 14:16:51   62 <b style='color:blue'>REGIST</b> ... lednicky@yahoo.com mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    1 2025-12-18 14:17:46   62   <b style='color:blue'>dupl</b> ... pro Ondřej Lednický nalezena id_osoba=764 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    1 2025-12-18 14:17:46   62   <b style='color:blue'>dupl</b> ... pro Marie Lednická nalezena id_osoba=765 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    1 2025-12-18 14:17:46   62 <b style='color:green'>POBYT </b> ... Ondřej Lednický, Marie Lednická id_pobyt=13 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    1 2025-12-19 22:44:14    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    1 2025-12-19 22:44:21   62 DOTAZ= ... už je přihlášen Ondřej Lednický  mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    1 2025-12-19 22:44:46   63 <b style='color:blue'>REGIST</b> ... pako@seznam.cz mail=pako@seznam.cz ip=127.0.0.1
2025.4/1    7 2026-01-23 10:44:00    ? <b style='color:red'>ERROR</b> CHYBA smtp/E: stream_socket_enable_crypto(): SSL operation failed with code 1. OpenSSL Error messages:
error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-23 10:44:23    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-23 10:44:26   64 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-23 10:45:08    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-23 10:45:10   65 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 11:30:10    ? <b style='color:red'>ERROR</b> CHYBA smtp/E: stream_socket_enable_crypto(): SSL operation failed with code 1. OpenSSL Error messages:
error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 11:30:10    ? <b style='color:red'>ERROR</b> CHYBA smtp/E: stream_socket_enable_crypto(): SSL operation failed with code 1. OpenSSL Error messages:
error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 13:24:49    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 13:24:52   66 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 13:30:14    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 13:30:16   67 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 16:34:12    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
2025.4/1    7 2026-01-26 16:34:14   68 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-01-26 16:44:08    ? MAIL? 4 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 764-a-567 764-a-568 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-01-26 16:44:09   69 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-01-26 16:48:31   69 <b style='color:green'>POBYT </b> ... Ondřej Lednický, Marie Ledmnická id_pobyt=14 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-01-26 16:48:55   70 <b style='color:blue'>REGIST</b> ... ondra.lednicky@volny.cz mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-01-26 16:52:17   71 <b style='color:blue'>REGIST</b> ... ondra.lednicky@volny.cz mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-01-26 16:53:24   71 <b style='color:green'>POBYT </b> ... Ondřej LednickýVolny id_pobyt=15 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:35:44   72 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:36:09   73 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:36:19    ? MAIL? 2 &times; lednicky@yahoo.com ...  764-a-501 764-a-566 (id_osoba-role-id_rodina) mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-03-24 19:36:31   74 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-03-24 19:42:50   75 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:43:56   75   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:44:14   76 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:45:39   76   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:51:00   77 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:52:18   77   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:52:39   78 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:55:22   79 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:56:29   79   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 19:56:51   80 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:01:31   80   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:01:40   81     80 ... Ondřej LednickýVolny id_osoba=884, id_rodina=-1 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:01:52   82 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:01:56   82   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:02:03   83     82 ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:02:03   83 <b style='color:red'>CATCH</b> Undefined property: stdClass::$rodina na řádku  1528:    |  739: form_R (0)  |  709: formular (0)  |  146: klient (884/0,0)  mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:09:00   84 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-03-24 20:09:40   85 KLIENT ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-03-24 20:09:59   86     85 ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-03-24 20:10:20   87 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:10:36   88 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:10:47   88   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:11:01   89     88 ... Ondřej LednickýVolny id_osoba=884, id_rodina=-1 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:11:10   89   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:11:24   90 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:11:33   90   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:11:45   91     90 ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:11:45   91 <b style='color:red'>CATCH</b> Undefined property: stdClass::$rodina na řádku  1529:    |  740: form_R (0)  |  710: formular (0)  |  146: klient (884/0,0)  mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:12:02   91 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:12:09   91   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:12:23   92 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:12:30   92   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:12:42   93 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:12:59   94 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:13:14   95 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:13:22   95   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:13:36   96 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:13:42   96   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:13:55   97 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:14:05   97   wait ... mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:14:14   98     97 ... Ondřej LednickýVolny id_osoba=884, id_rodina=-1 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:14:26   99 KLIENT ... Ondřej LednickýVolny id_osoba=884, id_rodina=0 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:14:53   99 <b style='color:green'>POBYT </b> ... Ondřej LednickýVolny id_pobyt=16 mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-03-24 20:15:09   99 DOTAZ= ... už je přihlášen Ondřej LednickýVolny  mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-04-21 22:52:55   99 DOTAZ= ... už je přihlášen Ondřej LednickýVolny  mail=ondra.lednicky@volny.cz ip=127.0.0.1
asc.4/1    7 2026-04-21 22:53:08  100     86 ... Ondřej Lednický id_osoba=764, id_rodina=566 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4/1    7 2026-04-21 22:53:23  100 <b style='color:green'>POBYT </b> ... Ondřej Lednický, Marie Ledmnická id_pobyt=17 mail=lednicky@yahoo.com ip=127.0.0.1
asc.4-edit     7 2026-04-26 19:56:09    ? <b style='color:orange'>EDIT</b> ... id_pobyt=16 admin user=1 změny: pocet1:0→1, pocet2:0→2, pocet3:0→3, pocet4:0→5, pocet5:0→6, web_json změněn mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:06:45    ? <b style='color:orange'>EDIT</b> ... id_pobyt=16 admin user=1 změny: prihlaska.vars_json synced (1×) mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:06:55    ? <b style='color:orange'>EDIT</b> ... id_pobyt=16 admin user=1 změny: web_json změněn, prihlaska.vars_json synced (1×) mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:09:15    ? <b style='color:orange'>EDIT</b> ... id_pobyt=17 admin user=1 změny: web_json změněn, prihlaska.vars_json synced (1×) mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:10:13    ? <b style='color:orange'>EDIT</b> ... id_pobyt=17 admin user=1 změny: pocet1:0→2, pocet2:0→2, pocet3:0→2, pocet4:0→2, pocet5:0→2, zadost:0→1, prihlaska.vars_json synced (1×) mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:33:00    ? <b style='color:orange'>EDIT</b> ... id_pobyt=18 admin user=1 změny: pocet1:0→1, pocet3:0→3, zadost:0→1, web_json změněn, prihlaska stub vytvořen (id_prihlaska=101) mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:34:32    ? <b style='color:orange'>EDIT</b> ... id_pobyt=18 admin user=1 změny: pocet4:0→2, pocet5:0→3, web_json změněn, prihlaska.vars_json synced (1×) mail=? ip=127.0.0.1
asc.4/1    7 2026-04-26 22:42:29  102 <b style='color:blue'>REGIST</b> ... ondrej.lednicky@mibcon.cz mail=ondrej.lednicky@mibcon.cz ip=127.0.0.1
asc.4/1    7 2026-04-26 22:42:53  102   wait ... mail=ondrej.lednicky@mibcon.cz ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:48:17    ? <b style='color:red'>DELETE</b> ... rozpracovaná id_prihlaska=64 email=lednicky@yahoo.com admin user=1 mail=? ip=127.0.0.1
asc.4-edit     7 2026-04-26 20:48:22    ? <b style='color:red'>DELETE</b> ... rozpracovaná id_prihlaska=65 email=lednicky@yahoo.com admin user=1 mail=? ip=127.0.0.1
