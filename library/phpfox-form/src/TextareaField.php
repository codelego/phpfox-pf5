<?php

namespace Phpfox\Form;

class TextareaField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $render = 'textarea';

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}