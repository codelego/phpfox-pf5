<?php

define('PHPFOX_NO_CACHE', 1);
define('PHPFOX_IS_DEV', true);

date_default_timezone_set('Australia/Adelaide');

include __DIR__ . '/config/bootstrap.php';

$string =  '?page[]=5';
$array = parse_url($string);
parse_str($array['query'], $query);

_dump($array,$query);
