<?php

include 'init.php';

$obj = new \Phpfox\Db\DbTableGatewayFactory();

$table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name'] : null;
$module_name = isset($_REQUEST['module_name']) ? $_REQUEST['module_name']
    : null;
$model_name = isset($_REQUEST['model_name']) ? $_REQUEST['model_name'] : null;
$model_id = isset($_REQUEST['model_id']) ? $_REQUEST['model_id'] : null;

if (!$model_id) {
    $model_id = $table_name;
}

if (!$model_name) {
    $model_name = _inflect(str_replace('_', ' ', $table_name));
}

if (!$table_name) {
    header('location: table2model1.php');
    exit;
}

$configure_url = http_build_query([
    'table_name'  => $table_name,
    'model_id'    => $model_id,
    'model_name'  => $model_name,
    'module_name' => $module_name,
]);
$meta = $obj->describe(':' . $table_name);

if (!$meta) {
    header('location: table2model1.php');
    exit;
}
$getterAndSetterMethods = [];
$initialData = '';
$assertSameMethods = [];
$setDataMethods = [];
$id_value = '0';

$savedData = Phpfox::get('db')
    ->select('*')
    ->from(':' . $table_name)
    ->first();

if ($savedData) {
    $savedData = json_decode(json_encode($savedData), true);
}

if (is_array($savedData)) {
    foreach ($savedData as $key => $value) {
        if (preg_match('/^\d+$/', $value)) {
            $value = (int)$value;
        }
        $savedData[$key] = $value;
    }
}


$columns = array_keys($meta[3]);
$keyId = $meta[0];
if (is_array($keyId)) {
    $keyId = array_keys($keyId);
    $keyId = array_shift($keyId);
}

if ($savedData) {
    $initialData = str_replace(PHP_EOL, '', var_export($savedData, true));
}

if ($keyId and isset($savedData[$keyId])) {
    $id_value = $savedData[$keyId];
}

$assertSameMethods[]
    = _sprintf('$this->assertSame(\'{model_id}\', $obj->getModelId());',
    ['model_id' => $model_id]);

foreach ($columns as $column) {
    $isBoolean = false;
    $value = isset($savedData[$column]) ? $savedData[$column] : '';

    if ($column == $keyId) {
        $name = 'Id';
    } else {
        $name = _inflect(str_replace('_', ' ', $column));
        $isBoolean = (substr($column, 0, 3) == 'is_');
    }

    if ($isBoolean) {
        $name = substr($name, 2);
    }

    $replacements = [
        'name'         => $name,
        'column'       => $column,
        'quoted_value' => is_string($value) ? "'" . $value . "'" : $value,
    ];

    // process get
    if ($isBoolean) {
        $getterAndSetterMethods[]
            = _sprintf('public function is{name}(){return $this->__get(\'{column}\') ?1:0;}',
            $replacements);
        $assertSameMethods[]
            = _sprintf('$this->assertSame({quoted_value}, $obj->is{name}());',
            $replacements);
    } else {
        if (is_int($value)) {
            $getterAndSetterMethods[]
                = _sprintf('public function get{name}(){return (int) $this->__get(\'{column}\');}',
                $replacements);

            $assertSameMethods[]
                = _sprintf('$this->assertSame({quoted_value}, $obj->get{name}());',
                $replacements);
        } else {
            $getterAndSetterMethods[]
                = _sprintf('public function get{name}(){return $this->__get(\'{column}\');}',
                $replacements);

            $assertSameMethods[]
                = _sprintf('$this->assertSame({quoted_value}, $obj->get{name}());',
                $replacements);
        }
    }

    // process get
    if ($isBoolean) {
        $getterAndSetterMethods[]
            = _sprintf('public function set{name}($value){$this->__set(\'{column}\',$value?1:0);}',
            $replacements);

    } else {
        $getterAndSetterMethods[]
            = _sprintf('public function set{name}($value){$this->__set(\'{column}\', $value);}',
            $replacements);

    }
    $setDataMethods[] = _sprintf('$obj->set{name}({quoted_value});',
        $replacements);

    $getterAndSetterMethods[] = '';

}

$replacements = [

    'getter_and_setter'  => implode(PHP_EOL . '    ', $getterAndSetterMethods),
    'assert_same_method' => implode(PHP_EOL . '        ', $assertSameMethods),
    'set_data_methods'   => implode(PHP_EOL . '        ', $setDataMethods),
    'initial_data'       => $initialData,
    'id_value'           => is_string($id_value) ? "'" . $id_value . "'"
        : $id_value,
    'id_key'             => $keyId,
    'table'              => $table_name,
    'table_name'         => $table_name,
    'module_name'        => $module_name,
    'model_name'         => $model_name,
    'model_id'           => $model_id,
];
$testTemplate = _sprintf(file_get_contents(__DIR__ . '/assets/model_test.tpl'),
    $replacements);
$configTemplate = _sprintf(file_get_contents(__DIR__
    . '/assets/model_config.tpl'), $replacements);
$classTemplate = _sprintf(file_get_contents(__DIR__
    . '/assets/model_class.tpl'), $replacements);

_rad_view_page('partial/_table2model2.php', [
    'configure_url'  => $configure_url,
    'heading'        => 'Convert Table 2 Model',
    'testTemplate'   => $testTemplate,
    'configTemplate' => $configTemplate,
    'classTemplate'  => $classTemplate,
]);