<?php

// make sure include this file only one.

if (defined('PHPFOX_BOOTSTRAP')) {
    return false;
}

define('PHPFOX_BOOTSTRAP', 1);

include __DIR__ . '/constants.php';
include __DIR__ . '/functions.php';

$cacheFiles = [
    'package'  => PHPFOX_CACHE_DIR . 'package.php',
    'autoload' => PHPFOX_CACHE_DIR . 'autoload.php',
];

$configFiles = [
    'package'  => PHPFOX_CONFIG_DIR . 'package.php',
    'autoload' => PHPFOX_CONFIG_DIR . 'autoload.php',
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
    'Phpfox' => __DIR__ . '/../library/phpfox-support/src/Phpfox.php',
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
    _autoload_psr4($autoloader, include $cacheFiles['autoload']);

    \Phpfox::init();

    $configContainer = \Phpfox::configs();
    $configContainer->merge(include $cacheFiles['package']);

} else {

    // load library data
    if (file_exists($configFiles['autoload'])) {
        $autoloadConfigs = include $configFiles['autoload'];
    } else {
        $autoloadConfigs = _merge_configs(PHPFOX_DIR . 'library',
            'autoload.php');
        _file_export($configFiles['autoload'], $autoloadConfigs);
    }

    if (file_exists($configFiles['package'])) {
        $packageConfigs = include $configFiles['package'];
    } else {
        $packageConfigs = _merge_configs_recursive(PHPFOX_DIR . 'library',
            'package.php');
        _file_export($configFiles['package'], $packageConfigs);
    }

    _autoload_psr4($autoloader, $autoloadConfigs);

    \Phpfox::init();


    $configContainer = \Phpfox::configs();

    $packageConfigs['db.adapters']['default'] = include PHPFOX_DATABASE_FILE;


    /**
     * Kernel's ready, getting started config extension packages.
     */
    $configContainer->merge($packageConfigs);


    /**
     * load extension package
     */
    $packageLoader = Phpfox::get('package.loader');

    $paths = $packageLoader->loadEnablePaths();

    $packageConfigs = [];


    $autoloadConfigs = array_merge($autoloadConfigs,
        Phpfox::get('package.loader')->loadAutoloadConfigs());


    _autoload_psr4($autoloader, $autoloadConfigs);

    _file_export($cacheFiles['autoload'], $autoloadConfigs);

    $configContainer->merge($packageLoader->loadPackageConfigs());
    _file_export($cacheFiles['package'], $configContainer->all());
}

\Phpfox::bootstrap();