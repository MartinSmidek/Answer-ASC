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
