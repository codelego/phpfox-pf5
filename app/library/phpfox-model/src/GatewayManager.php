<?php

namespace Phpfox\Model;


use Phpfox\Kernel\ParameterContainer;

class GatewayManager implements GatewayManagerInterface
{
    /**
     * @var GatewayInterface[]
     */
    protected $container = [];

    /**
     * @var ParameterContainer
     */
    protected $params;

    /**
     * GatewayManager constructor.
     */
    public function __construct()
    {
        $this->params = \Phpfox::get('package.loader')->getModelParameters();
    }

    public function set($id, $gateway)
    {
        $this->container[$id] = $gateway;
        return $this;
    }

    public function findById($id, $value)
    {
        return $this->get($id)->findById($value);
    }

    /**
     * @param string $id
     *
     * @return GatewayInterface
     */
    public function get($id)
    {
        return isset($this->container[$id])
            ? $this->container[$id]
            : $this->container[$id] = $this->factory($id);
    }

    public function factory($id)
    {
        $ref = $this->params->get($id);

        if (!$ref) {
            throw new GatewayException("gateway `$id` does not exists");
        }
        $factory = array_shift($ref);
        array_unshift($ref, $id);

        return call_user_func_array([
            \Phpfox::get($factory),
            'factory',
        ], $ref);
    }
}