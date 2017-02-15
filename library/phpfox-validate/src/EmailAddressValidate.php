<?php

namespace Phpfox\Validate;


class EmailAddressValidate extends Validate
{
    public function isValid($value)
    {
        $this->setValue($value);

        if (filter_var($value, FILTER_VALIDATE_EMAIL) !== false) {
            return true;
        }
        return false;
    }
}