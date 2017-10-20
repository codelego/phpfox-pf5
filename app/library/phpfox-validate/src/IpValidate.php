<?php

namespace Phpfox\Validate;

class IpValidate extends Validate
{
    public function isValid($value)
    {
        if (filter_var($value, FILTER_VALIDATE_IP) !== false) {
            return true;
        }

        return false;
    }
}