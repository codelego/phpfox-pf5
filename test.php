<?php

define('PHPFOX_NO_CACHE', 1);
define('PHPFOX_IS_DEV', true);

date_default_timezone_set('Australia/Adelaide');

include __DIR__ . '/config/bootstrap.php';

_dump(intval('128Kb') > intval('64M'));