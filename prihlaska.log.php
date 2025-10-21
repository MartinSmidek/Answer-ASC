<?php 
  session_start(); 
  if(!($_SESSION['ast']['user_id']??0) && !($_SESSION['db2']['user_id']??0) && !($_SESSION['dbt']['user_id']??0) && !isset($_GET['itsme'])) exit; 
?>
<html><head><title>přihlášky</title>
<link rel="shortcut icon" href="img/letter.png">
<script src="/ezer3.3/client/licensed/jquery-3.3.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="prihlaska_asc.3.js?corr=4" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">window.addEventListener('load', function() { pretty_log();});</script>  
</script>
</head><body><pre id="log"
><b>VERZE/JS  AKCE DATUM      ČAS      PŘIHLÁŠKA       KLIENT </b>
asc.3/4 ???? 2025-10-21 10:50:24    ? <b style='color:red'>CATCH</b> Undefined offset: -1 na řádku  46:    |  1846: require_once (C:\Ezer\bean...)  |  108: connect_db ()  |  19: require_once (C:\Ezer\bean...)  mail=? ip=127.0.0.1
asc.3/4 ???? 2025-10-21 11:48:16    ? <b style='color:red'>CATCH</b> Undefined property: stdClass::$FromName na řádku  3304:    |  480: simple_mail (,martin@smide...,PIN (4050) p...,V přihlášce ...)  |  465: poslat_pin ()  |  135: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
asc.3/4 ???? 2025-10-21 11:51:21    ? <b style='color:red'>CATCH</b> Undefined property: stdClass::$FromName na řádku  3304:    |  480: simple_mail (,martin@smide...,PIN (7625) p...,V přihlášce ...)  |  465: poslat_pin ()  |  135: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
asc.3/4 ???? 2025-10-21 11:58:31    1 <b style='color:blue'>REGIST</b> ... martin@smidek.eu mail=martin@smidek.eu ip=127.0.0.1
asc.3/4 ???? 2025-10-21 11:59:22    1 <b style='color:green'>POBYT </b> ... Martin Šmídek id_pobyt=2 mail=martin@smidek.eu ip=127.0.0.1
asc.3/4 ???? 2025-10-21 14:29:40    ? <b style='color:red'>CATCH</b> Array to string conversion na řádku  1925:    |  113: read_akce ()  |  19: require_once (C:\Ezer\bean...)  mail=? ip=127.0.0.1
asc.3/4 ???? 2025-10-21 14:42:56    1 <b style='color:blue'>REGIST</b> ... martin@smidek.eu mail=martin@smidek.eu ip=127.0.0.1
asc.3/4 ???? 2025-10-21 14:51:30    2 <b style='color:blue'>REGIST</b> ... martin@smidek.eu mail=martin@smidek.eu ip=127.0.0.1
asc.3/4 ???? 2025-10-21 14:51:55    2 <b style='color:green'>POBYT </b> ... Martin Šmídek id_pobyt=2 mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 15:50:32    ? <b style='color:red'>CATCH</b> Trying to get property 'code' of non-object na řádku  1854:    |  115: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 15:50:54    ? <b style='color:red'>CATCH</b> Trying to get property 'code' of non-object na řádku  1854:    |  115: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 15:56:53    ? <b style='color:red'>CATCH</b> Trying to get property 'code' of non-object na řádku  1851:    |  112: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 15:57:31    ? <b style='color:red'>CATCH</b> Trying to get property 'code' of non-object na řádku  1851:    |  112: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:01:43    ? <b style='color:red'>CATCH</b> Trying to get property 'deep' of non-object na řádku  1850:    |  112: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:01:44    ? <b style='color:red'>CATCH</b> Trying to get property 'deep' of non-object na řádku  1850:    |  112: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:02:47    ? <b style='color:red'>CATCH</b> Trying to get property 'deep' of non-object na řádku  1850:    |  112: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:03:13    ? <b style='color:red'>CATCH</b> Trying to get property 'deep' of non-object na řádku  1850:    |  112: connect_db ()  mail=? ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:05:14    ? <b style='color:red'>CATCH</b> Undefined property: stdClass::$cmtp na řádku  3293:    |  481: simple_mail (,martin@smide...,PIN (4367) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:06:02    ? <b style='color:red'>CATCH</b> Trying to access array offset on value of type bool na řádku  3716:    |  3346: select1_2 (hodnota,_cis,druh='smtp_s...)  |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (3206) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:06:46    ? <b style='color:red'>CATCH</b> Trying to access array offset on value of type bool na řádku  3716:    |  3346: select1_2 (hodnota,_cis,druh='smtp_s...)  |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (7733) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:08:42    ? <b style='color:red'>CATCH</b> Trying to access array offset on value of type bool na řádku  3716:    |  3346: select1_2 (hodnota,_cis,druh='smtp_s...)  |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (5873) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:10:20    ? <b style='color:red'>CATCH</b> Trying to access array offset on value of type bool na řádku  3716:    |  3346: select1_2 (hodnota,_cis,druh='smtp_s...)  |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (4531) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:11:04    ? <b style='color:red'>CATCH</b> Trying to access array offset on value of type bool na řádku  3716:    |  3346: select1_2 (hodnota,_cis,druh='smtp_s...)  |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (9290) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:11:24    ? <b style='color:red'>CATCH</b> Creating default object from empty value na řádku  3349:    |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (8144) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:13:26    ? <b style='color:red'>CATCH</b> Creating default object from empty value na řádku  3349:    |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (7686) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:15:23    ? <b style='color:red'>CATCH</b> Creating default object from empty value na řádku  3349:    |  3293: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (5899) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:26:29    ? <b style='color:red'>CATCH</b> Creating default object from empty value na řádku  3352:    |  3295: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (8955) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:31:41    3 KLIENT ... Martin Šmídek id_osoba=6, id_rodina=0 mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:34:26    ? <b style='color:red'>CATCH</b> Creating default object from empty value na řádku  3352:    |  3295: get_smtp (6)  |  481: simple_mail (,martin@smide...,PIN (7973) p...,V přihlášce ...)  |  466: poslat_pin ()  |  136: zadost_o_pin (martin@smide...)  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:34:39    2 DOTAZ= ... už je přihlášen Martin Šmídek  mail=martin@smidek.eu ip=127.0.0.1
2025.4/4 ???? 2025-10-21 16:34:53    4 <b style='color:blue'>REGIST</b> ... ohralj@seznam.cz mail=ohralj@seznam.cz ip=127.0.0.1
