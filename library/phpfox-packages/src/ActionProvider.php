<?php

namespace Phpfox\Package;

use Phpfox\Action\ActionProviderInterface;

class ActionProvider implements ActionProviderInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var bool
     */
    protected $initialized = false;


    protected function initialize()
    {
        $this->initialized = true;

        $this->data = _load('super.cache', 'controllers', 60, function () {
            return $this->_getControllers();
        });
    }


    public function get($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    /**
     * @return array
     */
    public function _getControllers()
    {
        $result = [];
        foreach (_get('package.loader')->getPaths() as $path) {
            if (!file_exists($filename = PHPFOX_DIR . $path . '/config/controller.php')) {
                continue;
            }

            /** @noinspection PhpIncludeInspection */
            if (!is_array($data = include $filename)) {
                continue;
            }

            foreach ($data as $k => $v) {
                $result[$k] = $v;
            }
        }
        return $result;
    }
}