<?php

namespace Phpfox\Form;

class ButtonField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $decorator = 'button';

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

    public function noLabel()
    {
        return $this->getParam('noLabel', true);
    }
}