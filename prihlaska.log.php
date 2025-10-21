<?php 
  session_start(); 
  if(!($_SESSION['db2']['user_id']??0) && !($_SESSION['dbt']['user_id']??0) && !isset($_GET['itsme'])) exit; 
?>
<html><head><title>přihlášky</title>
<link rel="shortcut icon" href="img/letter.png">
<script src="http://answer-test.bean:8080/ezer3.2/client/licensed/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="prihlaska_2025.3.js?corr=4" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">window.addEventListener('load', function() { pretty_log();});</script>  
</script>
</head><body><pre id="log"
><b>VERZE/JS  AKCE DATUM      ČAS      PŘIHLÁŠKA       KLIENT </b>
2025.3/4 ???? 2025-10-20 15:59:28    ? <b style='color:red'>CATCH</b> Undefined offset: -1 na řádku  46:    |  1871: require_once (C:\Ezer\bean...)  |  133: connect_db ()  |  30: require_once (C:\Ezer\bean...)  mail=? ip=127.0.0.1
2025.3/4 ???? 2025-10-20 15:59:37    ? <b style='color:red'>CATCH</b> Undefined offset: -1 na řádku  46:    |  1871: require_once (C:\Ezer\bean...)  |  133: connect_db ()  |  30: require_once (C:\Ezer\bean...)  mail=? ip=127.0.0.1
2025.3/4 ???? 2025-10-20 16:28:46    ? <b style='color:red'>CATCH</b> Undefined offset: -1 na řádku  46:    |  1871: require_once (C:\Ezer\bean...)  |  133: connect_db ()  |  30: require_once (C:\Ezer\bean...)  mail=? ip=127.0.0.1
