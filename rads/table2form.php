<?php

include 'init.php';

$mn = new \Phpfox\Db\DbTableGatewayFactory();

$table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name'] : '';
$form_type = isset($_REQUEST['form_type']) ? $_REQUEST['form_type'] : 'add';
$form_types = ['add', 'edit', 'delete'];
$module_name = isset($_REQUEST['module_name']) ? $_REQUEST['module_name']
    : null;
$form_name = isset($_REQUEST['form_name']) ? $_REQUEST['form_name'] : null;
$namespace = isset($_REQUEST['namespace']) ? $_REQUEST['namespace'] : null;
$test_has_elements = [];

$primary = null;
$skip_fields = [
    'created_at',
    'updated_at',
    'user_id',
    'parent_id',
    'parent_type',
    'poster_id',
    'poster_type',
    'view_count',
    'comment_count',
    'like_count',
    'share_count',
    'rating_avg',
];

$packages = array_map(function ($item) {
    return str_replace('package/', '', $item['path']);
}, Phpfox::get('db')
    ->select('*')
    ->from(':core_package')
    ->order('name', 1)
    ->all());

$tables = array_map(function ($item) {
    return str_replace(PHPFOX_TABLE_PREFIX, '', $item);
}, Phpfox::get('db')->tables());

if (empty($table_name)) {

    _rad_view_page('partial/_table2form1.php', [
        'tables'      => $tables,
        'heading'     => 'Table to Form',
        'table_name'  => $table_name,
        'form_types'  => $form_types,
        'form_type'   => $form_type,
        'form_name'   => $form_name,
        'module_name' => $module_name,
        'packages'    => $packages,
        'namespace'   => $namespace,
    ]);
}

if (isset($_POST['overwrite']) and $_POST['overwrite']) {
    $path = 'package/'.$_POST['module_name'];

    $form_path =  $path.'/src/Form/'. $form_name.'.php';
    $test_path =  $path.'/test/Form/'. $form_name.'Test.php';
    $success = true;

    if(!is_dir($dir =  dirname(PHPFOX_DIR  . $form_path))){
        echo 'mkdir -p ', $dir, '<br/>';
        $success = false;
    }

    if(!is_dir($dir =  dirname(PHPFOX_DIR  . '/' . $test_path))){
        echo 'mkdir -p ', $dir, '<br/>';
        $success = false;

    }

    if(!is_writable($dir =  dirname(PHPFOX_DIR  . $form_path))){
        echo 'chmod 777 ', $dir, '<br/>';
        $success = false;
    }

    if(!is_writable($dir =  dirname(PHPFOX_DIR   . $test_path))){
        echo 'chmod 777 ', $dir, '<br/>';
        $success = false;
    }

    if(!$success)exit;


    if(file_exists($filename = PHPFOX_DIR  . $form_path)
        and !is_writeable($filename)){
        echo 'chmod 777 '. $filename, '<br/>';
        $success = false;
    }

    if(file_exists($filename = PHPFOX_DIR  . $test_path)
        and !is_writeable($filename)){
        echo 'chmod 777 '. $filename, '<br/>';
        $success = false;
    }

    if(!$success)exit;

    _rad_put_contents($form_path,$_POST['form_template']);
    _rad_put_contents($test_path,$_POST['form_test_template']);
}

if (empty($namespace)) {
    $namespace = 'Neutron\\' . _inflect($module_name) . '\\Form';
}

if (empty($form_name)) {
    $form_name = _inflect($form_type . ' ' . str_replace('_', ' ',
            $table_name));
}

$rows = \Phpfox::db()
    ->execute('describe ' . PHPFOX_TABLE_PREFIX . $table_name)
    ->all();

$column = [];
$primary = [];
$identity = null;
$queryId = null;


foreach ($rows as $row) {
    $type = strtolower($row['Type']);
    $name = $row['Field'];
    $factory = 'text';
    $attributes = [
        'maxlength' => '$$$PHPFOX_TITLE_LENGTH$$$',
        'class'     => 'form-control',
    ];

    if (strtolower($row['Key']) == 'pri') {
        $primary = $row['Key'];
    }

    if (strtolower($row['Extra']) == 'auto_increment') {
        $identity = $row['Field'];
    }

    if (strpos($type, 'text') !== false) {
        $factory = 'textarea';
        $attributes = [
            'maxlength' => '$$$PHPFOX_DESC_LENGTH$$$',
            'class'     => 'form-control',
        ];
    }

    if ($name == 'description') {
        $attributes['rows'] = '$$$PHPFOX_DESC_ROWS$$$';
    }

    if ($name == 'category_id') {
        $factory = 'select';
    }


    $label = ucwords(implode(' ', explode('_', $name)));
    $required = $row['Null'] == 'NO' ? '$$$true$$$' : '$$$false$$$';
    $info['factory'] = $factory;
    $info['name'] = $name;
    if ($attributes) {
        $info['attributes'] = $attributes;
    }
    $info['label'] = '$$$_text($$' . $label . '$$)$$$';
    $info['required'] = $required;


    if (substr($name, 0, 3) == 'is_') {
        $info['factory'] = 'yesno';
        $info['value'] = 1;
        unset($info['attributes']);
    }

    $info['attributes'] = $attributes;
    $column[$name] = $info;
}

$response = [];
foreach ($column as $name => $info) {

    if (in_array($name, $skip_fields)) {
        continue;
    }

    if ($identity == $name) {
        continue;
    }

    $test_has_elements [] = _sprintf('$this->assertNotNull($form->getElement(\'{name}\'));',['name'=>$name]);

    $response[$name] = strtr(_sprintf('$this->addElement({info});', [
        'info' => var_export($info, true),
    ]), ['\'$$$' => '', '$$$\'' => '', '$$' => '\'']);
}

$test_has_element_assertions = implode(PHP_EOL.'        ', $test_has_elements);

$form_template = _sprintf(file_get_contents(__DIR__
    . '/assets/form_template.tpl'), [
    'namespace'   => $namespace,
    'form_name'   => $form_name,
    'initialize'  => implode(PHP_EOL . '        ', $response),
    'heading'     => 'Table to Form',
    'table_name'  => $table_name,
    'module_name' => $module_name,
    'form_type'   => $form_type,
]);

$form_test_template = _sprintf(file_get_contents(__DIR__
    . '/assets/form_test_template.tpl'), [
    'namespace'                   => $namespace,
    'form_name'                   => $form_name,
    'initialize'                  => implode(PHP_EOL . '        ', $response),
    'heading'                     => 'Table to Form',
    'table_name'                  => $table_name,
    'module_name'                 => $module_name,
    'form_type'                   => $form_type,
    'test_has_element_assertions' => $test_has_element_assertions,
]);


_rad_view_page('partial/_table2form2.php', [
    'tables'             => $tables,
    'heading'            => 'Table to Form',
    'table_name'         => $table_name,
    'form_name'          => $form_name,
    'form_types'         => $form_types,
    'module_name'        => $module_name,
    'form_type'          => $form_type,
    'form_template'      => $form_template,
    'namespace'          => $namespace,
    'form_test_template' => $form_test_template,
]);