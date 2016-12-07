<?php

namespace Phpfox\Form;


class Hidden extends Element implements FieldInterface
{
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

    public function noLabel()
    {
        return $this->getParam('noLabel', true);
    }
}