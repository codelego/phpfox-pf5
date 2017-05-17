<?php

namespace Phpfox\Package;


use Phpfox\Model\GatewayProviderInterface;

class ModelProvider implements GatewayProviderInterface
{
    protected $initialized = false;

    /**
     * @var array
     */
    protected $data;

    protected function initialize()
    {
        $this->initialized = true;

        $this->data = _load('super.cache', 'models', 60, function () {
            return $this->_getModels();
        });
    }

    public function _getModels()
    {
        $result = [];
        $paths = _get('package.loader')->getPaths();
        foreach ($paths as $path) {
            if (!file_exists($filename = PHPFOX_DIR . $path . '/config/model.php')) {
                continue;
            }

            /** @noinspection PhpIncludeInspection */
            $data = include $filename;

            if (!is_array($data)) {
                continue;
            }

            foreach ($data as $name => $value) {
                $result[$name] = $value;
            }
        }
        return $result;
    }

    public function get($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        return @$this->data[$id];
    }

    /**
     * @return array
     */
    public function all()
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        return $this->data;
    }
}