<?php

namespace Phpfox\Form;

class InputTextField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $render = 'input';

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

    }
}