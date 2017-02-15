<?php

include 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' and !empty($_REQUEST['overwrite'])) {

    $data = [
        'configure_url'  => $_POST['configure_url'],
        'heading'        => 'Convert Table 2 Model',
        'testTemplate'   => $_POST['template_test'],
        'configTemplate' => $_POST['template_config'],
        'classTemplate'  => $_POST['template_model'],
        'module_path'    => $_POST['module_path'],
        'model_path'     => $_POST['model_path'],
        'test_path'      => $_POST['test_path'],
    ];
    $path = $data['module_path'];
    $model_path = $path . '/' . $data['model_path'];
    $test_path = $path . '/' . $data['test_path'];
    $success = true;

    if(!is_dir($dir =  dirname(PHPFOX_DIR  . $model_path))){
        echo 'mkdir -p ', $dir, '<br/>';
        $success = false;
    }

    if(!is_dir($dir =  dirname(PHPFOX_DIR  . '/' . $test_path))){
        echo 'mkdir -p ', $dir, '<br/>';
        $success = false;
        
    }

    if(!is_writable($dir =  dirname(PHPFOX_DIR  . $model_path))){
        echo 'chmod 777 ', $dir, '<br/>';
        $success = false;
    }

    if(!is_writable($dir =  dirname(PHPFOX_DIR  . $test_path))){
        echo 'chmod 777 ', $dir, '<br/>';
        $success = false;
    }

    if(!$success)exit;


    if(file_exists($filename = PHPFOX_DIR  . $model_path)
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

    _rad_put_contents($model_path,$data['classTemplate']);
    _rad_put_contents($test_path,$data['testTemplate']);

} else {
    $obj = new \Phpfox\Db\DbTableGatewayFactory();

    $table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name']
        : null;
    $module_name = isset($_REQUEST['module_name']) ? $_REQUEST['module_name']
        : null;
    $model_name = isset($_REQUEST['model_name']) ? $_REQUEST['model_name']
        : null;
    $model_id = isset($_REQUEST['model_id']) ? $_REQUEST['model_id'] : null;
    $namespace = isset($_REQUEST['namespace']) ? $_REQUEST['namespace'] : null;

    if (!$model_id) {
        $model_id = $table_name;
    }

    if (!$model_name) {
        $model_name = _inflect(str_replace('_', ' ', $table_name));
    }

    if (!$namespace) {
        $namespace = _sprintf('Neutron\{namespace}\Model', [
            'namespace' => _inflect($module_name),
        ]);
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
        'namespace'   => $namespace,
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
    $whereArrays = [];
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

    foreach (array_keys($meta[1]) as $key) {
        $value = isset($savedData[$key]) ? $savedData[$key] : '';
        $whereArrays[] = _sprintf('->where(\'{key}=?\',{value})', [
            'key'   => $key,
            'value' => is_int($value) ? $value : "'" . $value . "'",
        ]);
    }

    $whereArrays = implode('', $whereArrays);

    if (is_array($keyId) and count($keyId) == 1) {
        $keyId = array_keys($keyId);
        $keyId = array_shift($keyId);
    }else if(!empty($meta[2])){
        $keyId = $meta[2];
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
        'where_condition'    => $whereArrays,
        'getter_and_setter'  => implode(PHP_EOL . '    ',
            $getterAndSetterMethods),
        'assert_same_method' => implode(PHP_EOL . '        ',
            $assertSameMethods),
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
        'namespace'          => $namespace,
    ];

    $testTemplate = _sprintf(file_get_contents(__DIR__
        . '/assets/model_test.tpl'),
        $replacements);
    $configTemplate = _sprintf(file_get_contents(__DIR__
        . '/assets/model_config.tpl'), $replacements);
    $classTemplate = _sprintf(file_get_contents(__DIR__
        . '/assets/model_class.tpl'), $replacements);

    $data = [
        'configure_url'  => $configure_url,
        'heading'        => 'Convert Table 2 Model',
        'testTemplate'   => $testTemplate,
        'configTemplate' => $configTemplate,
        'classTemplate'  => $classTemplate,
        'module_path'    => 'package/' . $module_name,
        'model_path'     => _sprintf('src/Model/{model_name}.php',
            ['model_name' => $model_name]),
        'test_path'      => _sprintf('test/Model/{model_name}Test.php',
            ['model_name' => $model_name]),
    ];
}


_rad_view_page('partial/_table2model2.php', $data);