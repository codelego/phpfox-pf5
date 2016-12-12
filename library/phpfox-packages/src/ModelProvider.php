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

        $paths = \Phpfox::get('package.loader')->loadEnablePaths();

        foreach ($paths as $path) {

            $data = include PHPFOX_DIR . $path
                . '/config/models.config.php';

            if (!is_array($data)) {
                continue;
            }

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

        return @$this->data[$id];
    }
}