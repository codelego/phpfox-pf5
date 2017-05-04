<?php

namespace Phpfox\Layout;


use Phpfox\View\ViewModel;

class Location
{
    /**
     * @var Block[]
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
     * @return Block[]
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param Block[] $blocks
     */
    public function setBlocks($blocks)
    {
        $this->blocks = $blocks;
    }

    /**
     * @param $element
     */
    public function addBlock(Block $element)
    {
        $this->blocks[] = $element;
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

        foreach ($this->blocks as $block) {
            $htmlArray[] = $block->render();
        }

        return implode('', $htmlArray);
    }

    /**
     * @return string
     */
    public function renderForEdit()
    {
        $htmlArray = [];

        foreach ($this->blocks as $block) {
            $htmlArray[] = $block->renderForEdit();
        }

        return (new ViewModel([
            'content'  => implode('', $htmlArray),
            'location' => $this,
        ], 'layout-editor/edit-location'))->render();
    }

}