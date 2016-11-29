<?php

namespace Phpfox\Form;


class FileUpload extends Element implements FieldInterface
{
    /**
     * @var string
     */
    protected $value = '';

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}