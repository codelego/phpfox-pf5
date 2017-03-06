<?php

namespace Phpfox\Validate;

class RequiredValidate extends Validate
{
    protected $defaults = ['skip' => true,];

    public function isValid($value)
    {
        if ($value === null or $value === '') {
            return false;
        }
        return true;
    }
}