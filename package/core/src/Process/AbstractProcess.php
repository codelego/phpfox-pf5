<?php

namespace Neutron\Core\Process;


abstract class AbstractProcess implements ProcessInterface
{
    protected $params = [];

    /**
     * EditSimpleItemTask constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * @return mixed
     */
    abstract function process();
}