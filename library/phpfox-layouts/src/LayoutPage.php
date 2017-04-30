<?php

namespace Phpfox\Layout;

use Phpfox\View\ViewModel;

class LayoutPage
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var LayoutLocation[]
     */
    protected $location = [];

    /**
     * @var array
     */
    protected $params = [];

    public function __construct($name, $params = [])
    {
        $this->name = $name;
        $this->params = $params;
    }

    /**
     * add new location
     *
     * @param LayoutLocation $location
     */
    public function addLocation($location)
    {
        $this->location[$location->getName()] = $location;
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
        foreach ($this->location as $key => $location) {
            $data[$key] = $location->render();
        }

        \Phpfox::get('assets')
            ->addMeta('debug.page_name', ['name' => 'layout_page', 'content' => $this->name]);

        $script = $this->get('layout', 'grid/simple');

        return (new ViewModel($data, $script))->render();
    }

    /**
     * @inheritdoc
     */
    public function __sleep()
    {
        return ['name', 'location', 'params'];
    }
}