<?php

// make sure include this file only one.

if (defined('PHPFOX_BOOTSTRAP')) {
    return false;
}

define('PHPFOX_BOOTSTRAP', 1);

include __DIR__ . '/constants.php';
include __DIR__ . '/functions.php';


$autoloader = include __DIR__ . '/../vendor/autoload.php';

include_once PHPFOX_DIR . 'library/phpfox-support/src/Phpfox.php';

Phpfox::init();
