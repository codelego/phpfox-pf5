<?php

namespace Phpfox\Form;

class Checkbox extends Element implements FieldInterface
{


    protected $render = 'checkbox';

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
        return $this;
    }

    public function isChecked()
    {
        return $this->value == $this->getParam('checkedValue', 1);
    }

    public function noLabel()
    {
        return $this->getParam('noRender', true);
    }
}