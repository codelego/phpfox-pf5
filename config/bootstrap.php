<?php

// make sure include this file only one.

if (defined('PHPFOX_BOOTSTRAP')) {
    return false;
}

define('PHPFOX_BOOTSTRAP', 1);

include __DIR__ . '/constants.php';
include __DIR__ . '/functions.php';

$cacheFiles = [
    'package.config'  => PHPFOX_DIR . 'data/cache/package.config.php',
    'autoload.config' => PHPFOX_DIR . 'data/cache/autoload.config.php',
];

$configFiles = [
    'package.config'  => PHPFOX_DIR . 'config/package.config.php',
    'autoload.config' => PHPFOX_DIR . 'config/autoload.config.php',
];

$shouldGenerate = PHPFOX_ENV != 'production';

foreach ($cacheFiles as $file) {
    if (!file_exists($file)) {
        $shouldGenerate = true;
        break;
    }
}

$autoloader = include __DIR__ . '/../vendor/autoload.php';

// this wrapper is not belong to namespace.
$autoloader->addClassMap([
    'Phpfox' => __DIR__ . '/../library/phpfox-mvc/src/Phpfox.php',
]);

//if (PHP_SAPI == "cli") {
//    $whoops = new \Whoops\Run;
//    $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
//    $whoops->register();
//} else {
//    $whoops = new \Whoops\Run;
//    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//    $whoops->register();
//}


if (!$shouldGenerate) {
    _autoload_psr4($autoloader, include $cacheFiles['autoload.config']);

    \Phpfox::init();

    $configContainer = \Phpfox::mvcConfig();
    $configContainer->merge(include $cacheFiles['package.config']);

} else {

    $packageVariables = _merge_configs_recursive([PHPFOX_DIR . '/library',],
        'package.config.php');


    $autoloadConfigs = _merge_configs([PHPFOX_DIR . '/library',],
        'autoload.config.php');

    unset($autoloadConfigs['']);


    _file_export($configFiles['package.config'], $packageVariables);
    _file_export($configFiles['autoload.config'], $autoloadConfigs);

    _autoload_psr4($autoloader, $autoloadConfigs);
    \Phpfox::init();

    $configContainer = \Phpfox::mvcConfig();

    $packageVariables['db.adapters']['default'] = include PHPFOX_DIR
        . '/config/db.init.php';

    /**
     * Kernel's ready, getting started config extension packages.
     */
    $configContainer->merge($packageVariables);


    /**
     * load extension package
     */
    $packageLoader = Phpfox::get('package.loader');

    $paths = $packageLoader->loadEnablePaths();

    $packageVariables = [];


    $autoloadConfigs = array_merge($autoloadConfigs,
        Phpfox::get('package.loader')->loadAutoloadConfigs());


    _autoload_psr4($autoloader, $autoloadConfigs);

    _file_export($cacheFiles['autoload.config'], $autoloadConfigs);
    $configContainer->merge($packageLoader->loadPackageConfigs());

    _file_export($cacheFiles['package.config'], $configContainer->all());
}

\Phpfox::bootstrap();