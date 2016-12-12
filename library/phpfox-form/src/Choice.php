<?php

namespace Phpfox\Form;

class Choice extends Element implements FieldInterface
{
    protected $value;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $render = 'select';

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}