<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\AdminRadSetting;
use Phpfox\Db\DbTableGatewayFactory;
use Phpfox\View\ViewModel;

class AdminRadController extends AdminController
{

    protected $skipFormFields
        = [
            'params',
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

    protected function initialized()
    {

    }

    public function actionIndex()
    {
        $methodMaps = [
            'form_add'     => 'generateFormAdd',
            'form_edit'    => 'generateFormEdit',
            'form_delete'  => 'generateFormDelete',
            'model'        => 'generateModel',
            'model_config' => 'geneateModelConfig',
        ];
        $req = _service('request');

        $form = new AdminRadSetting([]);

        if ($req->isGet()) {

        }
        if ($req->isPost() and $form->isValid($req->all())) {
            $data = $form->getData();
            $packageId = $data['package_id'];
            $tables = $data['tables'];
            $cmds = $data['cmds'];

            foreach ($tables as $table) {
                foreach ($cmds as $cmd) {
                    if (method_exists($this, $method = $methodMaps[$cmd])) {
                        $this->{$method}($packageId, $table);
                    }
                }
            }

        }


        return new ViewModel([
            'form'    => $form,
            'heading' => 'Configure',
        ], 'layout/form-edit');
    }

    public function generateFormAdd($packageId, $table)
    {
        $this->_generateForm($packageId, $table, 'Add');
    }

    public function generateFormEdit($packageId, $table)
    {
        $this->_generateForm($packageId, $table, 'Edit');
    }

    /**
     * @param $table_name
     * @param $packageId
     *
     * @return bool
     */
    protected function generateModel($packageId, $table_name)
    {

        $obj = new DbTableGatewayFactory();
        $model_name = null;
        $model_id = null;
        $namespace = null;
        $packageInfo = $this->_getPackageInfo($packageId);
        $module_path = $packageInfo['path'];

        if (!$model_name) {
            $model_name = _inflect(str_replace('_', ' ', $table_name));
        }

        if (!$namespace) {
            $namespace = _sprintf('Neutron\{namespace}\Model', [
                'namespace' => _inflect($packageId),
            ]);
        }

        $meta = $obj->describe(':' . $table_name);

        if (!$meta) {
            return false;
        }

        $getterAndSetterMethods = [];
        $initialData = '';
        $assertSameMethods = [];
        $setDataMethods = [];
        $whereArrays = [];
        $id_value = '0';

        $savedData = _service('db')
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
        } else {
            if (!empty($meta[2])) {
                $keyId = $meta[2];
            }
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
            'module_name'        => $packageId,
            'model_name'         => $model_name,
            'model_id'           => $model_id,
            'namespace'          => $namespace,
        ];


        $configTemplate = $this->_translate('model_config.txt', $replacements);
        $classTemplate = $this->_translate('model_class.txt', $replacements);
        $testTemplate = $this->_translate('model_test.txt', $replacements);

        $model_path = $module_path . '/src/Model/' . $model_name . '.php';
        $test_path = $module_path . '/test/Model/' . $model_name . 'Test.php';
        $config_path = $module_path . '/config/model.php';

        $errors = $this->_ensureWritable([
            $model_path,
            $test_path,
        ]);

        if (!empty($errors)) {
            exit($errors);
        }

        $this->putContents($model_path, $classTemplate);
        $this->putContents($test_path, $testTemplate);

        return true;
    }

    protected function _generateForm($packageId, $table_name, $form_type)
    {
        $namespace = 'Neutron\\' . _inflect($packageId) . '\\Form';

        $form_name = _inflect($form_type . ' ' . str_replace('_', ' ',
                $table_name));

        $packageInfo = $this->_getPackageInfo($packageId);

        $module_path = $packageInfo['path'];
        $form_path = $module_path . '/src/Form/' . $form_name . '.php';
        $test_path = $module_path . '/test/Form/' . $form_name . 'Test.php';


        $rows = _service('db')
            ->execute('describe ' . PHPFOX_TABLE_PREFIX . $table_name)
            ->all();

        $column = [];
        $identity = null;
        $primary = null;
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
//                $primary = $row['Key'];
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

            if ($name == 'package_id') {
                $factory = 'select';
                $info['options'] = '$$$_get($$'.'core.packages'.'$$)->getPackageIdOptions()$$$';
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
        $test_has_elements = [];
        foreach ($column as $name => $info) {
            if (in_array($name, $this->skipFormFields)) {
                continue;
            }
            if ($identity == $name) {
                continue;
            }
            $test_has_elements [] = _sprintf('$this->assertNotNull($form->getElement(\'{name}\'));', ['name' => $name]);
            $response[$name] = strtr(_sprintf('$this->addElement({info});', [
                'info' => var_export($info, true),
            ]), ['\'$$$' => '', '$$$\'' => '', '$$' => '\'','\\\\'=>'\\']);
        }

        $test_has_element_assertions = implode(PHP_EOL . '        ', $test_has_elements);

        $form_template = $this->_translate('form_template.txt', [
            'namespace'   => $namespace,
            'form_name'   => $form_name,
            'initialize'  => implode(PHP_EOL . '        ', $response),
            'heading'     => 'Table to Form',
            'table_name'  => $table_name,
            'module_name' => $packageId,
            'form_type'   => $form_type,
        ]);

        $form_test_template = $this->_translate('form_test_template.txt', [
            'namespace'                   => $namespace,
            'form_name'                   => $form_name,
            'initialize'                  => implode(PHP_EOL . '        ', $response),
            'heading'                     => 'Table to Form',
            'table_name'                  => $table_name,
            'module_name'                 => $packageId,
            'form_type'                   => $form_type,
            'test_has_element_assertions' => $test_has_element_assertions,
        ]);

        $errors = $this->_ensureWritable([
            $form_path,
            $test_path,
        ]);

        if (!empty($errors)) {
            exit($errors);
        }

        $this->putContents($form_path, $form_template);
        $this->putContents($test_path, $form_test_template);
    }

    /**
     * Ensure filename is writable
     *
     * @param array $files
     *
     * @return string
     */
    public function _ensureWritable($files)
    {
        $errors = [];

        foreach ($files as $filename) {
            if (!is_dir($dir = dirname(PHPFOX_DIR . $filename))) {
                $errors[] = 'mkdir -p ' . $dir;

            }
            if (!is_writable($dir = dirname(PHPFOX_DIR . $filename))) {
                $errors[] = 'chmod 777 ' . $dir;
            }

            if (file_exists($filename = PHPFOX_DIR . $filename) and !is_writeable($filename)) {
                $errors[] = 'chmod 777 ' . $filename;
            }
        }
        return implode('<br />', $errors);
    }

    protected function putContents($file, $data)
    {
        $file = PHPFOX_DIR . $file;

        if (file_exists($file)) {
            @unlink($file);
        }

        if (!is_dir($dir = dirname($file)) && !@mkdir($dir, 0777, true)) {
            exit('Can not open ' . $dir . ' to write export');
        }

        file_put_contents($file, $data);

        if (file_exists($file)) {
            @chmod($file, 0777);
        }
    }

    /**
     * @param string $file         template file name under ./core/assets
     * @param array  $replacements array data
     *
     * @return string
     */
    protected function _translate($file, $replacements)
    {
        $filename = realpath(__DIR__ . '/../../assets') . '/' . $file;
        return _sprintf(file_get_contents($filename), $replacements);
    }

    /**
     * @param string $packageId
     *
     * @return array
     */
    protected function _getPackageInfo($packageId)
    {
        return _service('db')
            ->select('*')
            ->from(':core_package')
            ->where('name=?', $packageId)
            ->first();
    }
}