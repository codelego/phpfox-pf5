<?php

namespace Phpfox\Validate;

class IntegerValidate extends Validate
{
    public function isValid($value)
    {
        if (is_integer($value)) {
            return true;
        }
        if (preg_match('/^\d+$/', $value)) {
            return true;
        }
        return false;
    }
}