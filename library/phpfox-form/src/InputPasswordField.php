<?php

namespace Phpfox\Form;


class InputPasswordField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $render = 'password';

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}