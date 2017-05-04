<?php

namespace Phpfox\Layout;

class Page
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $actionId;

    /**
     * @var string
     */
    protected $themeId;

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
     * @param string $name
     * @param string $actionId
     * @param string $themeId
     * @param array  $params
     */
    public function __construct($name, $actionId, $themeId, $params = [])
    {
        $this->name = $name;
        $this->actionId = $actionId;
        $this->themeId = $themeId;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @param string $actionId
     */
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }

    /**
     * @return string
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * @param string $themeId
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
        \Phpfox::get('assets')
            ->addMeta('debug.page_name',
                ['name' => 'layout_page', 'content' => $this->name]);

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

    /**
     * @inheritdoc
     */
    public function __sleep()
    {
        return ['name', 'location', 'params'];
    }
}