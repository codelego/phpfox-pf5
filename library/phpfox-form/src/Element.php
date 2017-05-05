<?php

namespace Phpfox\Form;


class Element implements ElementInterface
{
    /**
     * @var ElementInterface|null
     */
    protected $parent = null;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var string
     */
    protected $render = 'text';

    /**
     * @var string
     */
    protected $label;

    /**
     * @var bool
     */
    protected $required;

    /**
     * Element constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $k => $v) {
            if (method_exists($this, $method = 'set' . ucfirst($k))) {
                $this->{$method}($v);
            } else {
                $this->params[$k] = $v;
            }
        }
        $this->initialize();
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    protected function initialize()
    {

    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        foreach ($params as $k => $v) {
            $this->params[$k] = $v;
        }
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function getAttribute($name, $default = null)
    {
        return isset($this->attributes[$name])
            ? $this->attributes[$name] : $default;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getRender()
    {
        return $this->render;
    }

    public function setRender($render)
    {
        $this->render = $render;
    }

    public function hasAttribute($name)
    {
        return !empty($this->attributes[$name]);
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    public function noLabel()
    {
        return (bool)$this->getParam('noLabel', false);
    }

    public function getParam($name, $default = null)
    {
        return isset($this->params[$name]) ? $this->params[$name] : $default;
    }

    public function noWrap()
    {
        return $this->getParam('noWrap', false);
    }

    public function setElements($elements)
    {
        if ($this instanceof CollectionInterface) {
            $this->addElements($elements);
        }
    }

    public function render()
    {
        return _get('form_render')->render($this);
    }
}