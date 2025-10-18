<?php # Systém An(w)er/YMCA Setkání/YMCA Familia, (c) 2008-2015 Martin Šmídek <martin@smidek.eu>

  # inicializace systémů Ans(w)er
  #   $app        = kořenová podsložka aplikace ... db2
  #   $app_name   = jméno aplikace
  #   $app_js     = pole s *.js
  #   $app_css    = pole s *.css
  #   $options    = doplnění Ezer.options
  #   $add_pars   = doplnění $EZER->options

  // verze použitého jádra Ezeru
  $ezer_version= isset($_GET['ezer']) ? $_GET['ezer'] : '3.3'; 

  // server, databáze, cesty, klíče
  $deep_root= "../files/asc";
  require_once("$deep_root/asc.dbs.php");

  // parametry aplikace Answer/db2
  $app_name=  "Answer";
  $app= $app_root=  'asc';
  $app_version_in= 'db2';
  $skin= 'ch';

  $title_style= $ezer_server ? '' : "style='color:#ef7f13'" ;
  $title_flag=  $ezer_server ? '' : 'lokální ';
  $CKEditor= isset($_GET['editor']) ? $_GET['editor'] : '4.6';

  // nastav PDO=2
  $_GET['pdo']= 2;

  // ochránění přímého přístupu do složek s .htaccess/RewriteCond "%{HTTP_COOKIE}" "!EZER"
  setcookie("EZER",$app,0,"/");

  // skin a css
  $cookie= 8;
  $app_last_access= "asc_last_access";

  $app_js= array("db2/ds_fce3.js","db2/db2_fce3.js");
  
  $app_css= [ 
      "db2/db2.css",
      "db2/db2.css.php=skin",
      "ezer$ezer_version/client/wiki.css"
   ];

  //  require_once("asc.php");
  $add_options= (object) [
    'watch_access' => 8,
    'group_db'     => "'ezer_answer'",
    'watch_access_opt' => // ... barvení v Uživatelé + select v ezer2.syst.ezer
       "{name:{8:'ASC'},
         abbr:{8:'M'},
         css:{8:'ezer_ms'}}",
    'web'          => "'manzelskasetkani.cz'", // web organizace - pro odmítnutí odhlášení
    'skill'        => "'d'",
    'autoskill'    => "'!d'",
    'db_test'      => 0,
    'dbg'          => "{path:['db2','asc']}"
  ];

  // (re)definice Ezer.options
  $title= "<span $title_style>$title_flag$app_name<sub>3.2</sub> Šance pro manželství</span>";
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

