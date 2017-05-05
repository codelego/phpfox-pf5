<?php

include 'init.php';

$packages = array_map(function ($item) {
    return str_replace('package/', '', $item['path']);
}, _get('db')
    ->select('*')
    ->from(':core_package')
    ->order('name', 1)
    ->all());

$tables = array_map(function ($item) {
    return str_replace(PHPFOX_TABLE_PREFIX, '', $item);
}, _get('db')->tables());


$table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name'] : null;
$module_name = isset($_REQUEST['module_name']) ? $_REQUEST['module_name']
    : null;
$model_id = isset($_REQUEST['model_id']) ? $_REQUEST['model_id'] : null;
$model_name = isset($_REQUEST['model_name']) ? $_REQUEST['model_name'] : null;
$namespace =    isset($_REQUEST['namespace']) ? $_REQUEST['namespace'] : null;

_rad_view_page('partial/_table2model1.php', [
    'heading'     => 'Convert Table To Model',
    'table_name'  => $table_name,
    'model_name'  => $model_name,
    'module_name' => $module_name,
    'model_id'    => $model_id,
    'packages'    => $packages,
    'tables'      => $tables,
    'namespace'=> $namespace,
]);