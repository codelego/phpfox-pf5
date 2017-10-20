<?php

namespace Neutron\User\Auth;


use Phpfox\Auth\PasswordCompatibleInterface;

class Pf5PasswordCompatible implements PasswordCompatibleInterface
{
    public function isValid($input, $hashed, $salt, $static)
    {
        return $this->createHash($input, $salt) == $hashed;
    }

    public function createHash($input, $salt, $static = null)
    {
        return sha1(md5($input) . $salt);
    }

    public function createSalt($length = 5)
    {
        return _random_string($length);
    }

}