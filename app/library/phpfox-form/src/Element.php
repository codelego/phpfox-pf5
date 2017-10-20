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
    protected $decorator = 'text';

    /**
     * @var bool
     */
    protected $required;

    static $attributeKeys
        = [
            'type'           => 1,
            'class'          => 1,
            'onclick'        => 1,
            'onchange'       => 1,
            'maxlength'      => 1,
            'onsubmit'       => 1,
            'title'          => 1,
            'rows'           => 1,
            'cols'           => 1,
            'placeholder'    => 1,
            'disabled'       => 1,
            'readonly'       => 1,
            'editable'       => 1,
            'size'           => 1,
            'multiple'       => 1,
            'target'         => 1,
            'spellcheck'     => 1,
            'autocomplete'   => 1,
            'autocorrect'    => 1,
            'autocapitalize' => 1,

        ];

    /**
     * Element constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (method_exists($this, $method = 'set' . ucfirst($key))) {
                $this->{$method}($value);
            } elseif (isset(self::$attributeKeys[$key])) {
                $this->attributes[$key] = $value;
            } elseif (in_array(substr($key, 0, 5), ['data-', 'aria-'])) {
                $this->attributes[$key] = $value;
            } else {
                $this->params[$key] = $value;
            }
        }
        $this->beforeInitialize();
        $this->initialize();
        $this->afterInitialize();
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    protected function afterInitialize()
    {
    }

    protected function beforeInitialize()
    {
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
        if ($this->attributes) {
            $this->attributes = array_merge($this->attributes, $attributes);
        } else {
            $this->attributes = $attributes;
        }
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

    public function getDecorator()
    {
        return $this->decorator;
    }

    public function setDecorator($decorator)
    {
        $this->decorator = $decorator;
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
        return $this->getParam('label', '');
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->setParam('label', (string)$label);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getParam('label', '');
    }

    /**
     * @param string $label
     */
    public function setTitle($label)
    {
        $this->setParam('label', (string)$label);
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->getParam('note', '');
    }

    /**
     * @param string $label
     */
    public function setNote($label)
    {
        $this->setParam('note', (string)$label);
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->getParam('info', '');
    }

    /**
     * @param string $label
     */
    public function setInfo($label)
    {
        $this->setParam('info', (string)$label);
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

    /**
     * @return string
     */
    public function render()
    {
        return \Phpfox::get('form_render')->render($this);
    }
}