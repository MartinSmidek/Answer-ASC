<?php # Systém Answer pro ASC, (c) 2025 Martin Šmídek <martin@smidek.eu>

  # inicializace systémů Ans(w)er
  #   $app        = kořenová podsložka aplikace ... db2
  #   $app_name   = jméno aplikace
  #   $app_js     = pole s *.js
  #   $app_css    = pole s *.css
  #   $options    = doplnění Ezer.options
  #   $add_pars   = doplnění $EZER->options
  $test= '-test'; // '' ostrá verze, '-test' testovací

  // verze použitého jádra Ezeru
  $ezer_version= isset($_GET['ezer']) ? $_GET['ezer'] : '3.3'; 

  // server, databáze, cesty, klíče
  $deep_root= "../files/asc$test";
  require_once("$deep_root/asc.dbs.php");

  // parametry aplikace Answer/db2
  $app_name=  "Answer$test";
  $app= $app_root=  "asc";
  $app_version_in= "db2$test";
  $skin= 'tt';

  $title_style= $ezer_server ? '' : "style='color:#ef7f13'" ;
  $title_flag=  $ezer_server ? '' : 'lokální ';
  $CKEditor= isset($_GET['editor']) ? $_GET['editor'] : '4.6';

  // nastav PDO=2
  $_GET['pdo']= 2;

  // ochránění přímého přístupu do složek s .htaccess/RewriteCond "%{HTTP_COOKIE}" "!EZER"
  setcookie("EZER",$app,0,"/");

  // upozornění na testovací verzi, po kliku zmizí
  $demo= '';
  $click= "jQuery('#DEMO').fadeOut(500);";
  $dstyle= "left:-50px; bottom:0; position:fixed; transform:rotate(40deg) translate(-107px,-14px); "
      . "width:500px;height:80px;background:orange; color:white; font-weight: bolder; "
      . "text-align: center; font-size: 40px; line-height: 75px; z-index: 16; opacity: .5;";
  $demo= "<div id='DEMO' onmouseover=\"$click\" style='$dstyle'>testovací data</div>";
  // skin a css
  $cookie= 8;
  $app_last_access= "{$app}_last_access";

  $app_js= array("db2/ds_fce3.js","db2/db2_fce3.js");
  
  $app_css= [ 
      "db2/db2.css",
      "db2/db2.css.php=skin",
      "ezer$ezer_version/client/wiki.css"
   ];

  $add_options= (object) [
    'watch_access' => 32,
    'group_db'     => "'ezer_answer'",
    'watch_access_opt' => // ... barvení v Uživatelé + select v ezer2.syst.ezer
       "{name:{32:'ASC'},
         abbr:{32:'A'},
         css:{32:'ezer_ms'}}",
    'web'          => "'https://www.ascczech.cz'", // web organizace - pro odmítnutí odhlášení
    'skill'        => "'d'",
    'autoskill'    => "'!d'",
    'db_test'      => 0,
    'dbg'          => "{path:['db2$test','asc$test']}"
  ];

  // (re)definice Ezer.options
  $title= "$demo<span $title_style>$title_flag$app_name<sub style='font-size:55%'>$ezer_version</sub> "
      . "Sdružení salesiánů spolupracovníků</span>";
  $add_pars= array(
    'favicon' => array("{$app}_local.png","{$app}.png","{$app}_dsm.png")[$ezer_server],
    'watch_key' => 1,   // true = povolit přístup jen po vložení klíče
    'watch_ip' => 1,    // true = povolit přístup jen ze známých IP adres
    'title_right' => $title,
    'CKEditor' => "{
        version:'$CKEditor',
        Minimal:{toolbar:[['Bold','Italic','Source']]},
        IntranetSlim:{
          toolbar:[['Bold','Italic','-','Link','Unlink','-','Source']],
          removePlugins:'wsc,elementspath,scayt'
        },
        'EzerMail':{toolbar:[['PasteFromWord',
          '-','Format','Bold','Italic','TextColor','BGColor',
          '-','JustifyLeft','JustifyCenter','JustifyRight',
          '-','Link','Unlink','HorizontalRule','Image',
          '-','NumberedList','BulletedList',
          '-','Outdent','Indent',
          '-','Source','ShowBlocks','RemoveFormat']]
        }
      }"
  );

  // je to aplikace se startem v kořenu
  require_once("ezer$ezer_version/ezer_main.php");

