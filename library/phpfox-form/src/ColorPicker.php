<?php

namespace Phpfox\Form;


class ColorPicker implements FieldInterface
{
    use ElementTrait;

    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        $this->setAttribute('value', $value);
        return $this;
    }
}