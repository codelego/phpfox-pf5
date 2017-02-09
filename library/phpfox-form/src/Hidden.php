<?php

namespace Phpfox\Form;


class Hidden extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $render = 'input';

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function noLabel()
    {
        return $this->getParam('noLabel', true);
    }
}