<?php

namespace Phpfox\Layout;


use Phpfox\View\ViewModel;

class Location
{
    /**
     * @var array[]
     */
    protected $blocks = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * LayoutLocation constructor.
     *
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getContainerId()
    {
        return $this->get('container_id');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->get('location_id');
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->get('location_id');
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
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }
    }

    /**
     * @param array $block
     */
    public function addBlock($block)
    {
        $this->blocks[] = $block;
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
    }

    /**
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
        if (empty($this->blocks)) {
            return '';
        }

        $htmlArray = [];

        $layouts = \Phpfox::get('layouts');

        foreach ($this->blocks as $block) {
            $htmlArray[] = $layouts->renderBlock($block['block_class'], $block);
        }

        return implode('', $htmlArray);
    }

    /**
     * @return string
     */
    public function renderForEdit()
    {
        return (new ViewModel([
            'blocks'   => $this->blocks,
            'location' => $this->params,
        ], 'layout-editor/edit-location'))->render();
    }

}