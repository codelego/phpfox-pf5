<?php
namespace Neutron\User\Auth;


use Phpfox\Authentication\PasswordCompatibleInterface;

class Pf4PasswordCompatible implements PasswordCompatibleInterface
{

    public function isValid($input, $hashed, $salt, $static)
    {
        if (strlen($hashed) > 32) {
            if (!function_exists('crypt')) {
                return false;
            }
            $ret = crypt($input, $hashed);
            if (!is_string($ret)
                || $this->check_str_length($ret)
                != $this->check_str_length($hashed)
                || $this->check_str_length($ret) <= 13
            ) {
                return false;
            }

            $status = 0;
            for ($i = 0; $i < $this->check_str_length($ret); $i++) {
                $status |= (ord($ret[$i]) ^ ord($hashed[$i]));
            }

            return $status === 0;
        } else {
            return md5(md5($input) . md5($salt)) == $hashed;
        }
    }

    function check_str_length($binary_string)
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($binary_string, '8bit');
        }
        return strlen($binary_string);
    }

    public function createHash($input, $salt, $static = null)
    {
        return md5(md5($input) . md5($salt));
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