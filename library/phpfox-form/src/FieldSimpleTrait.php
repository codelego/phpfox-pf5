<?php

namespace Phpfox\Form;


Trait FieldSimpleTrait
{
    /**
     * @var mixed
     */
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}