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

if (PHP_SAPI == "cli") {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler());
    $whoops->register();
} else {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}


if (!$shouldGenerate) {
    _autoload_psr4($autoloader, include $cacheFiles['psr4.init']);

    \Phpfox::init();

    $configContainer = \Phpfox::mvcConfig();
    $configContainer->merge(include $cacheFiles['service.init']);

} else {

    $packageVariables = _merge_library_config([PHPFOX_DIR . '/library']);
    $settingVariables = [];

    _autoload_psr4($autoloader, $packageVariables['psr4']);
    \Phpfox::init();

    /** @var \Phpfox\Mvc\MvcConfig $configContainer */
    $configContainer = \Phpfox::mvcConfig();

    $packageVariables['db.adapters']['default'] = include PHPFOX_DIR
        . '/config/db.init.php';

    $configContainer->merge($packageVariables);

    /** @var \Phpfox\Mysqli\MysqliDbAdapter $db */
    $db = \Phpfox::get('db');


    $rows = $db->select('*')->from(':core_package')->where('is_active=?', 1)
        ->order('priority', 1)->execute()->all();

    $packageVariables = [];

    /**
     * fetch package variables from package.php
     */
    foreach ($rows as $row) {
        _array_merge_recursive($packageVariables,
            include PHPFOX_DIR . '/' . $row['path'] . '/config/package.php');

    }
    $configContainer->merge($packageVariables);
    unset($rows, $packageVariables);


    /**
     * fetch setting variables from table ':core_setting'
     */
    $rows = $db->select('group_id, var_name, value_actual, is_active, priority')
        ->from(':core_setting')->where('is_active=?', 1)->order('priority', 1)
        ->execute()->all();


    foreach ($rows as $row) {
        $key = $row['var_name'];
        $group = $row['group_id'];
        if (!$group) {
            $group = 'global';
        }

        if (!isset($settingVariables[$group])) {
            $settingVariables[$group] = [];
        }

        $val = json_decode($row['value_actual'], true);
        if (isset($val['val'])) {
            $val = $val['val'];
        } else {
            continue;
        }

        $settingVariables[$group][$key] = $val;
    }

    $configContainer->merge($settingVariables);
    unset($rows, $settingVariables);

    $all = $configContainer->all();
    _autoload_psr4($autoloader, $all['psr4']);

    _file_export($cacheFiles['psr4.init'], $all['psr4']);
    unset($all['psr4']);

    ksort($all);
    _file_export($cacheFiles['service.init'], $all);

    unset($all);
}