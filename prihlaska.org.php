<?php
/*
  (c) 2025 Martin Smidek <martin@smidek.eu>

  konfigurace online přihlašování pro ASC

 */

$ORG= (object)[
  'code'  => 32,
  'smtp'  => 3,
  'name'  => 'ASC',
  'deep'  => 'asc-test/asc.dbs.php', // podsložka files
  'icon'  => '/img/prihl_test_icon.png',
  // default pro garanta akce, pokud není dostupný z AKCE/Úprava
  'info'  => (object)[
      'name'=>'Ondřej Lednický',
      'mail'=>'ondra.lednicky@volny.cz',
      'tlfn'=>'734 647 785',
    ],
];
