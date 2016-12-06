<?php

namespace Phpfox\Form;

trait FieldMultiValuesTrait
{
    /**
     * @var array
     */
    protected $multiOptions = [];

    /**
     * @var string
     */
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getMultiOptions()
    {
        return $this->multiOptions;
    }

    /**
     * @param array $multiOptions
     */
    public function setMultiOptions($multiOptions)
    {
        $this->multiOptions = $multiOptions;
    }
}