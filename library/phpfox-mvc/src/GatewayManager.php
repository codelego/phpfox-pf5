<?php
/**
 * Copyright (c) 2016. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace Phpfox\Mvc;


/**
 * Class GatewayManager
 *
 * @package Phpfox\Mvc
 */
class GatewayManager implements GatewayManagerInterface
{
    /**
     * @var GatewayInterface[]
     */
    protected $container = [];

    /**
     * @var string[]
     */
    protected $map = [];

    public function __construct()
    {
        $this->map = config('models');
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
        return isset($this->container[$id]) ? $this->container[$id]
            : $this->container[$id] = $this->build($id);
    }

    public function build($id)
    {
        if (!isset($this->map[$id])
            || !class_exists($this->map[$id][0])
        ) {
            throw new GatewayException("gateway `$id` does not exists");
        }

        list($gateway, $modelClass, $collection, $adapter) = $this->map[$id];

        if (!class_exists($gateway) || !class_exists($modelClass)) {
            throw new GatewayException("gateway `$id` does not exists");
        }

        return new $gateway($collection, $modelClass, $id, $adapter);
    }
}