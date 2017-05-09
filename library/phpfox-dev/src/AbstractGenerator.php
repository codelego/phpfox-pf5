<?php

namespace Phpfox\RapidDev;


class AbstractGenerator
{
    /**
     * @var string
     */
    protected $packageId;


    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $formType;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $textDomain = null;

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * AbstractGenerator constructor.
     *
     * @param array $meta
     */
    public function __construct(array $meta)
    {
        unset($meta['metadata']);
        $this->metadata = $meta;

        foreach ($meta as $key => $value) {
            if (method_exists($this, $method_name = 'set' . ucfirst($key))) {
                $this->{$method_name}($value);
            }
        }

        $this->initialized();
    }

    protected function initialized()
    {

    }

    public function readSettings($name)
    {
        if (file_exists($filename = __DIR__ . '/../assets/' . $name . '.php')) {
            return include $filename;
        }
        return [];
    }

    /**
     * @param string $name
     * @param array  $data
     */
    public function writeSettings($name, $data)
    {
        if (file_exists($filename = __DIR__ . '/../assets/' . $name . '.php')) {
            $array = include $filename;
        } else {
            $array = [];
        }
        $array = array_merge($array, $data);

        $content = '<?php return ' . var_export($array, true) . ';';

        @unlink($filename);
        file_put_contents($filename, $content);
    }

    /**
     * @return string
     */
    public function getNameSpace()
    {
        return 'Neutron\\' . _inflect($this->packageId) . '\\' . ucfirst(strtolower($this->category));
    }

    /**
     * @return string
     */
    public function getShortFormClass()
    {
        $string = $this->formType . ' ' . str_replace('_', ' ', $this->tableName);
        return _inflect($string);
    }

    /**
     * @return string
     */
    public function getComponent()
    {
        return _inflect(str_replace('_', ' ', $this->tableName));
    }

    public function getFullFormClass()
    {
        return _sprintf('{0}\\{1}', [
            $this->getNameSpace(),
            $this->getShortFormClass(),
        ]);
    }

    protected function putContents($filename, $data)
    {
        $errors = $this->ensureWritable([
            $filename,
        ]);

        if (!empty($errors)) {
            exit($errors);
        }

        $filename = PHPFOX_DIR . $filename;


        file_put_contents($filename, $data);

        if (file_exists($filename)) {
            @chmod($filename, 0777);
        }
    }

    /**
     * @param string $file         template file name under ./core/assets
     * @param array  $replacements array data
     *
     * @return string
     */
    protected function translate($file, $replacements)
    {
        $filename = $this->getAssetsDirectory() . '/' . $file;
        return _sprintf(file_get_contents($filename), $replacements);
    }

    protected function getAssetsDirectory()
    {
        return realpath(__DIR__ . '/../assets');
    }

    /**
     * @return array
     */
    protected function getPackageInfo()
    {
        return _service('db')
            ->select('*')
            ->from(':core_package')
            ->where('name=?', $this->packageId)
            ->first();
    }

    /**
     * @return string
     */
    protected function getFormTitle()
    {
        $string = ucfirst($this->formType) . ' ' . implode(' ', array_map(function ($v) {
                return ucwords($v);
            }, explode('_', $this->tableName)));

        $string = preg_replace("/(Admin|I18n)/", '', $string);

        $string = preg_replace("/(\s+)/", ' ', $string);

        return $string;
    }

    /**
     * Ensure filename is writable
     *
     * @param array $files
     *
     * @return string
     */
    public function ensureWritable($files)
    {
        $errors = [];

        foreach ($files as $filename) {
            if (!is_dir($dir = dirname(PHPFOX_DIR . $filename))) {
                if(!@mkdir($dir, 0777, true)){
                    $errors[] = 'mkdir -p ' . $dir;
                }else{
                    @chmod($dir, 0777);
                }
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

    /**
     * @return string
     */
    public function getPackageId()
    {
        return $this->packageId;
    }

    /**
     * @param string $packageId
     */
    public function setPackageId($packageId)
    {
        $this->packageId = $packageId;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string $formType
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getTextDomain()
    {
        return $this->textDomain;
    }

    /**
     * @param string $textDomain
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;
    }
}