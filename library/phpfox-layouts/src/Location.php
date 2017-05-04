<?php

namespace Phpfox\Layout;


use Phpfox\View\ViewModel;

class Location
{
    /**
     * @var string
     */
    protected $name;

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
     * @param string $name
     * @param array  $params
     */
    public function __construct($name, $params = [])
    {
        $this->name = $name;
        $this->params = $params;
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