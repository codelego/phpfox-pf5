<?php
namespace Phpfox\Validate;

class NullValidate extends Validate
{
    protected $skip = false;

    public function isValid($value)
    {
        return true;
    }
}