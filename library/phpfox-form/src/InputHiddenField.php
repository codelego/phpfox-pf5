<?php

namespace Phpfox\Form;


class InputHiddenField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $render = 'hidden';

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function noWrap()
    {
        return true;
    }

    public function noLabel()
    {
        return true;
    }
}