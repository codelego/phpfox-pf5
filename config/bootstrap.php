<?php

// make sure include this file only one.

if (defined('PHPFOX_BOOTSTRAP')) {
    return false;
}

define('PHPFOX_BOOTSTRAP', 1);

include __DIR__ . '/constants.php';
include __DIR__ . '/functions.php';

$cacheFiles = [
    'service.init' => PHPFOX_DIR . '/data/cache/service.init.php',
    'psr4.init'    => PHPFOX_DIR . '/data/cache/psr4.init.php',
];

$shouldGenerate = PHPFOX_NO_CACHE;

foreach ($cacheFiles as $file) {
    if (!file_exists($file)) {
        $shouldGenerate = true;
        break;
    }
}

$autoloader = include __DIR__ . '/../vendor/autoload.php';

// this wrapper is not belong to namespace.
$autoloader->addClassMap([
    'Phpfox' => __DIR__ . '/../library/phpfox-mvc/lib/Phpfox.php',
]);

if (!$shouldGenerate) {
    _autoload_psr4($autoloader, include $cacheFiles['psr4.init']);

    \Phpfox::init();

    $configs = \Phpfox::getConfigContainer();
    $configs->merge(include $cacheFiles['service.init']);

} else {

    $merged = _merge_library_config([PHPFOX_DIR . '/library']);
    _autoload_psr4($autoloader, $merged['autoload.psr4']);

    \Phpfox::init();
    $configs = \Phpfox::getConfigContainer();

    $merged['db.adapters']['default'] = include PHPFOX_DIR
        . '/config/db.init.php';

    $configs->merge($merged);

    /** @var \Phpfox\Mysqli\MysqliAdapter $db */
    $db = \Phpfox::get('db');

    /** @var \Phpfox\Mvc\ConfigContainer $configs */
    $rows = $db->select('*')->from(':core_package')->where('is_active=?', 1)
        ->order('priority', 1)->execute()->fetch();

    $merged = [];
    foreach ($rows as $row) {
        _array_merge_recursive($merged,
            include PHPFOX_DIR . '/' . $row['path'] . '/config/package.php');

    }

    $configs->merge($merged);
    $all = $configs->all();

    _autoload_psr4($autoloader, $all['autoload.psr4']);

    _file_export($cacheFiles['psr4.init'], $all['autoload.psr4']);
    unset($all['autoload.psr4']);

    ksort($all);
    _file_export($cacheFiles['service.init'], $all);

    unset($all);
}