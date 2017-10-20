<?php

// make sure include this file only one.

if (defined('PHPFOX_BOOTSTRAP')) {
    return false;
}

define('PHPFOX_BOOTSTRAP', 1);

include __DIR__ . '/constant.php';
include __DIR__ . '/function.php';


$autoloader = include __DIR__ . '/../vendor/autoload.php';

include_once PHPFOX_LIBRARY_DIR . 'phpfox-kernel/src/Phpfox.php';

Phpfox::init();
