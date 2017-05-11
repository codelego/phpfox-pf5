<?php

namespace Neutron\Dev;


use Neutron\Core\Model\CorePackage;
use Neutron\Dev\Model\DevActionMeta;
use Phpfox\Db\DbTableGatewayFactory;
use Phpfox\View\ViewModel;

class ModelGenerator extends AbstractGenerator
{

    /**
     * @var string
     */
    protected $category = 'Model';

    /**
     * @var DevActionMeta $meta
     */
    protected $meta;

    /**
     * @var CorePackage
     */
    protected $packageInfo;

    /**
     * @var string
     */
    protected $textDomain;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $packageId;

    /**
     * @var string
     */
    protected $formType;

    /**
     * Template script
     *
     * @var string
     */
    protected $template;

    /**
     * AbstractGenerator constructor.
     *
     * @param DevActionMeta $meta
     */
    public function __construct(DevActionMeta $meta)
    {
        $this->meta = $meta;

        $this->textDomain = $this->meta->getTextDomain();

        $this->tableName = $this->meta->getTableName();

        $this->packageId = $this->meta->getPackageId();

        $this->packageInfo = _model('core_package')
            ->select()
            ->where('name=?', $this->packageId)
            ->first();

        $this->initialized();
    }

    protected function initialized()
    {

    }

    protected function getElementParams()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getNameSpace()
    {
        return 'Neutron\\' . _inflect($this->meta->getPackageId()) . '\\Model';
    }

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
        $packageInfo = $this->packageInfo;
        $modulePath = $packageInfo->getPath();
        $modelClassPath = $modulePath . '/src/Model/' . $modelName . '.php';
        $testCasePath = $modulePath . '/test/Model/' . $modelName . 'Test.php';
        $modelSpecPath = $modulePath . '/config/model/' . $modelId . '.php';

        switch ($this->meta->getActionId()) {
            case 'delete':
                if (file_exists($modelClassPath)) {
                    @unlink($modelClassPath);
                }
                if (file_exists($testCasePath)) {
                    @unlink($testCasePath);
                }
                if (file_exists($modelSpecPath)) {
                    @unlink($modelSpecPath);
                }
                return true;
            case 'skip':
                return true;
            default:
        }

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
            = _sprintf('$this->assertSame(\'{modelId}\', $obj->getModelId());',
            ['modelId' => $modelId]);

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
            'whereConditions'  => $whereArrays,
            'getterAndSetter'  => implode(PHP_EOL . '    ',
                $getterAndSetterMethods),
            'assertSameMethod' => implode(PHP_EOL . '        ',
                $assertSameMethods),
            'setDataMethods'   => implode(PHP_EOL . '        ', $setDataMethods),
            'initialData'      => $initialData,
            'id_value'         => is_string($id_value) ? "'" . $id_value . "'"
                : $id_value,
            'id_key'           => $keyId,
            'table'            => $tableName,
            'table_name'       => $tableName,
            'moduleName'       => $packageId,
            'modulePath'       => $modulePath,
            'modelName'        => $modelName,
            'modelId'          => $modelId,
            'namespace'        => $namespace,
        ];


        $configCode = (new ViewModel($replacements, 'dev/template/model-config'))->render();
        $modelClassCode = (new ViewModel($replacements, 'dev/template/model-class'))->render();
        $testCaseClassCode = (new ViewModel($replacements, 'dev/template/model-test-case-class'))->render();

        $errors = $this->ensureWritable([
            $modelClassPath,
            $testCasePath,
        ]);

        if (!empty($errors)) {
            exit($errors);
        }

        @unlink($modelSpecPath);

        $this->putContents($modelClassPath, $modelClassCode);
        $this->putContents($testCasePath, $testCaseClassCode);
        $this->putContents($modelSpecPath, $configCode . '.bk');

        return true;
    }
}