<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\PasswordCompatibleInterface;

class Pf4PasswordCompatible implements PasswordCompatibleInterface
{

    public function isValid($input, $hashed, $salt, $static)
    {
        if (strlen($hashed) > 32) {
            $ret = crypt($input, $hashed);
            if (!is_string($ret)
                || mb_strlen($ret, '8bit')
                != mb_strlen($hashed, '8bit')
                || mb_strlen($ret, '8bit') <= 13
            ) {
                return false;
            }

            $status = 0;
            for ($i = 0; $i < mb_strlen($ret, '8bit'); $i++) {
                $status |= (ord($ret[$i]) ^ ord($hashed[$i]));
            }

            return $status === 0;
        } else {
            return md5(md5($input) . md5($salt)) == $hashed;
        }
    }

    public function createHash($input, $salt, $static = null)
    {
        return md5(md5($input) . md5($salt));
    }

    public function createSalt($length = 5)
    {
        return _random_string($length);
    }
}