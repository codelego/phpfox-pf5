<?php

define('PHPFOX_NO_CACHE', 1);
define('PHPFOX_IS_DEV', false);
define('PHPFOX_ENV', 'development');

date_default_timezone_set('Australia/Adelaide');

include __DIR__ . '/config/bootstrap.php';

_get('session')->start();

_get('dispatcher')->run();