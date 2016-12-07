<?php

namespace Phpfox\Form;


Trait ElementTrait
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
    protected $render;

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
                $this->setParam($k, $v);
            }
        }
        $this->initialize();
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    protected function initialize()
    {

    }

    public function getParam($name)
    {
        return isset($this->params[$name]) ? $this->params[$name] : null;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    public function getAttribute($name)
    {
        return $this->attributes[$name];
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
        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function getRender()
    {
        return $this->render;
    }

    public function setRender($render)
    {
        $this->render = $render;
        return $this;
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
     *
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    public function noLabel()
    {
        return false;
    }
}