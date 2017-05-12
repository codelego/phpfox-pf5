<?php

namespace Phpfox\Form;


class InputPasswordField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $decorator = 'input';

    protected $attributes= ['class' => 'form-control', 'maxlength' => 255,'type'=>'password'];

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}