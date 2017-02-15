<?php

namespace Phpfox\Validate;

class RequiredValidate extends Validate
{
    protected $skip = true;

    public function isValid($value)
    {
        $this->setValue($value);

        if ($value === null or $value === '') {
            return false;
        }
        return true;
    }
}