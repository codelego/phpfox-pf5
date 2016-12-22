<?php

namespace Phpfox\Package;

use Phpfox\Mvc\ControllerProviderInterface;

class ControllerProvider implements ControllerProviderInterface
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

        $paths = \Phpfox::get('package.loader')->loadEnablePaths();

        foreach ($paths as $path) {

            $data = include PHPFOX_DIR . $path
                . '/config/controller.php';

            foreach ($data as $k => $v) {
                $this->data[$k] = $v;
            }
        }
    }


    public function get($id)
    {
        if (!$this->initialized) {
            $this->initialize();
        }

        return isset($this->data[$id]) ? $this->data[$id] : null;
    }
}