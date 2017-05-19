<?php

define('PHPFOX_NO_CACHE', 1);
define('PHPFOX_IS_DEV', true);

date_default_timezone_set('Australia/Adelaide');

include __DIR__ . '/config/bootstrap.php';

echo json_encode(array (
    'type' => 'class',
    'value' => 'Memcache',
    'error' => '<strong>Memcache</strong> extension is required to active this option',
));