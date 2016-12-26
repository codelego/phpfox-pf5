<?php

namespace Phpfox\Form;

class MultiChoice extends Element implements FieldInterface
{
    /**
     * @var array
     */
    protected $value = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
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