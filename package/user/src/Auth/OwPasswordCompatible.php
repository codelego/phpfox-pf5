<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\PasswordCompatibleInterface;

class OwPasswordCompatible implements PasswordCompatibleInterface
{
    public function isValid($input, $hashed, $salt, $static)
    {
        return $this->createHash($input, '', $static) == $hashed;
    }

    public function createHash($input, $salt, $static = null)
    {
        return hash('sha256', $static . $input);
    }

    public function createSalt($length = 5)
    {
        return _random_string($length);
    }
}