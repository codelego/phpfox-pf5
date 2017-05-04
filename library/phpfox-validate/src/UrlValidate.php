<?php

namespace Phpfox\Validate;


class UrlValidate extends Validate
{
    public function isValid($value)
    {
        if (filter_var($value, FILTER_VALIDATE_URL) !== false) {
            return true;
        }

        return false;
    }
}