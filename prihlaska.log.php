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
