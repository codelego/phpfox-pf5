<?php

include __DIR__ . '/constants.php';


$autoloader = include __DIR__ . '/../vendor/autoload.php';

$psr4Array = include __DIR__ . '/psr4.init.php';

foreach ($psr4Array as $namespace => $paths) {
    foreach ($paths as $path) {
        $autoloader->addPsr4($namespace, PHPFOX_DIR . '/' . $path);
    }
}


include __DIR__ . '/functions.php';