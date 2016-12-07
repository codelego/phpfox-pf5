<?php

namespace Phpfox\Form;

class Button extends Element implements FieldInterface
{
    /**
     * @var
     */
    protected $value;

    /**
     * @var string
     */
    protected $render = 'button';

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

    public function noLabel()
    {
        return $this->getParam('noLabel', true);
    }
}