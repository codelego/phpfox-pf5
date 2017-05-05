<?php

namespace Phpfox\Form;

class CheckboxField extends Element implements FieldInterface
{
    protected $render = 'checkbox';

    /**
     * @var mixed
     */
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
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->value == $this->getParam('checkedValue', 1);
    }

    public function noLabel()
    {
        return $this->getParam('noRender', true);
    }
}