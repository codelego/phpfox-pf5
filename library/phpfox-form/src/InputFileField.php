<?php

namespace Phpfox\Form;


class InputFileField extends Element implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $value;

    protected $decorator = 'file_upload';

    protected $attributes= ['type'=>'hidden'];

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}