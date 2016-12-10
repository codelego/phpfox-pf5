<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\PasswordCompatibleInterface;

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
        $result = '';
        $seeks = '0123456789qwertyuiopasdfghjklzxcvbnm';
        $max = strlen($seeks) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $result .= substr($seeks, mt_rand(0, $max), 1);
        }
        return $result;
    }

}