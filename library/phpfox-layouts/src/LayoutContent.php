<?php

namespace Phpfox\Layout;

class LayoutContent
{
    protected $name;

    /**
     * @var Container[]
     */
    protected $containers = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * LayoutPage constructor.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * add new container
     *
     * @param Container $layoutContainer
     */
    public function addContainer($layoutContainer)
    {
        $this->containers[] = $layoutContainer;
    }

    /**
     * @return Container[]
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * @param Container[] $containers
     */
    public function setContainers($containers)
    {
        $this->containers = $containers;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Get parameters
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
     * Set parameters
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @return string
     */
    public function render()
    {
        $data = [];
        foreach ($this->containers as $container) {
            $data[] = $container->render();
        }

        return implode(PHP_EOL, $data);
    }

    /**
     * @return string
     */
    public function renderForEdit()
    {
        $data = [];
        foreach ($this->containers as $container) {
            $data[] = $container->renderForEdit();
        }

        return implode(PHP_EOL, $data);
    }
}