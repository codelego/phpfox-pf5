<?php

// make sure include this file only one.

if (defined('PHPFOX_BOOTSTRAP')) {
    return false;
}

define('PHPFOX_BOOTSTRAP', 1);

include __DIR__ . '/constants.php';
include __DIR__ . '/functions.php';

$cacheFiles = [
    'package'  => PHPFOX_CACHE_DIR . '_package.php',
    'autoload' => PHPFOX_CACHE_DIR . '_autoload.php',
];

$configFiles = [
    'autoload' => PHPFOX_CACHE_DIR . '_autoload.library.php',
    'package'  => PHPFOX_CACHE_DIR . '_parameter.library.php',
];

$shouldGenerate = PHPFOX_ENV == 'development';

foreach ($cacheFiles as $file) {
    if (!file_exists($file)) {
        $shouldGenerate = true;
        break;
    }
}

$autoloader = include __DIR__ . '/../vendor/autoload.php';

include_once PHPFOX_DIR . 'library/phpfox-support/src/Phpfox.php';

if ($shouldGenerate) {
    @unlink($configFiles['autoload']);
}

if (!file_exists($configFiles['autoload'])
    or !file_exists($configFiles['package'])
) {
    Phpfox::buildLibraryFiles($configFiles['autoload'], $configFiles['package']);
}

Phpfox::addPsr4($configFiles['autoload']);
Phpfox::init();
Phpfox::configs()->merge(include $configFiles['package']);

$cache = _get('super.cache');

if ($item = $cache->getItem('parameters')) {
    $data = $item->value;
} else {
}


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

Phpfox::addPsr4($autoloadConfigs);

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
$packageLoader = _get('package.loader');

$paths = $packageLoader->getPaths();

$packageConfigs = [];


$autoloadConfigs = array_merge($autoloadConfigs,
    _get('package.loader')->getAutoload());


_autoload_psr4($autoloader, $autoloadConfigs);

_file_export($cacheFiles['autoload'], $autoloadConfigs);

$configContainer->merge($packageLoader->getParameters());
_file_export($cacheFiles['package'], $configContainer->getData());


\Phpfox::bootstrap();