<?php

namespace Phpfox\Form;


class StaticField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $decorator = 'static_text';

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}