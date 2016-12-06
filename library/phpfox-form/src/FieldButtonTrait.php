<?php

namespace Phpfox\Form;

trait FieldButtonTrait
{
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
        $this->setAttribute('value', $value);
        $this->value = $value;
        return $this;
    }
}