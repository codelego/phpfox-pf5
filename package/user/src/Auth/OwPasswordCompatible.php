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
        $result = '';
        $seeks = '0123456789qwertyuiopasdfghjklzxcvbnm';
        $max = strlen($seeks) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $result .= substr($seeks, mt_rand(0, $max), 1);
        }
        return $result;
    }
}