<?php

namespace Phpfox\Layout;


class LayoutLocation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * full section, section, column
     *
     * @var string
     */
    protected $type;

    /**
     * @var LayoutElement[]
     */
    protected $elements = [];

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return LayoutElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param LayoutElement[] $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param $element
     */
    public function add(LayoutElement $element)
    {
        $this->elements[] = $element;
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
        if (empty($this->elements)) {
            return '';
        }

        $htmlArray = [];

        foreach ($this->elements as $element) {
            $htmlArray[] = $element->render();
        }

        return implode('', $htmlArray);
    }
}