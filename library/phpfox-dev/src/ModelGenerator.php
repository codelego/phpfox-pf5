<?php

namespace Phpfox\RapidDev;


use Phpfox\Db\DbTableGatewayFactory;

class ModelGenerator extends AbstractGenerator
{

    protected $category = 'Model';

    /**
     * @return array|mixed
     */
    public function process()
    {

        $packageId = $this->packageId;
        $tableName = $this->tableName;

        $tableInfo = new TableInfo($this->tableName);

        $obj = new DbTableGatewayFactory();
        $modelName = _inflect(str_replace('_', ' ', $tableName));;
        $modelId = $tableName;
        $namespace = $this->getNameSpace();
        $packageInfo = $this->getPackageInfo();
        $modulePath = $packageInfo['path'];

        $meta = $obj->describe(':' . $tableName);

        if (!$meta) {
            exit('Table ' . $tableName . ' does not exists');
        }

        $getterAndSetterMethods = [];
        $initialData = '';
        $assertSameMethods = [];
        $setDataMethods = [];
        $whereArrays = [];
        $id_value = '0';

        $savedData = _service('db')
            ->select('*')
            ->from(':' . $tableName)
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
            ['model_id' => $modelId]);

        foreach ($tableInfo->getColumns() as $column) {
            $name = $column->getName();
            $isBoolean = $column->isBoolean();
            $value = isset($savedData[$name]) ? $savedData[$name] : '';

            if ($column->isPrimary()) {
                $name = 'Id';
            } else {
                $name = _inflect(str_replace('_', ' ', $name));
            }

            if ($isBoolean) {
                $name = substr($name, 2);
            }

            $replacements = [
                'name'         => $name,
                'column'       => $column->getName(),
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
            'table'              => $tableName,
            'table_name'         => $tableName,
            'module_name'        => $packageId,
            'model_name'         => $modelName,
            'model_id'           => $modelId,
            'namespace'          => $namespace,
        ];


        $configCode = $this->translate('model_config.txt', $replacements);
        $modelClassCode = $this->translate('model_class.txt', $replacements);
        $testCaseClassCode = $this->translate('model_test_case_class.txt', $replacements);

        $modelClassPath = $modulePath . '/src/Model/' . $modelName . '.php';
        $testCasePath = $modulePath . '/test/Model/' . $modelName . 'Test.php';
        $configPath = $modulePath . '/config/model.php';
        $modelSpecPath = $modulePath . '/config/model/' . $modelId . '.php';

        $errors = $this->ensureWritable([
            $modelClassPath,
            $testCasePath,
        ]);

        if (!empty($errors)) {
            exit($errors);
        }

        @unlink($modelSpecPath);

        if (file_exists($modelClassPath)) {
            rename($modelClassPath, $modelClassPath . '.bk');
        }

        $this->putContents($modelClassPath, $modelClassCode);
        $this->putContents($testCasePath, $testCaseClassCode);

        return [
            'configCode' => $configCode,
            'configPath' => $configPath,
        ];
    }
}