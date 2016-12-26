<?php

namespace Phpfox\Form;


class StaticText extends Element implements FieldInterface
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