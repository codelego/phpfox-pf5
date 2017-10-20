<?php

namespace Phpfox\Form;


class InputEmailField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $decorator = 'input';

    protected $attributes = ['class' => 'form-control', 'maxlength' => 255, 'type' => 'email'];

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}