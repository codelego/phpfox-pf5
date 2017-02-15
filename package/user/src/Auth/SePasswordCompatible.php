<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\PasswordCompatibleInterface;

class SePasswordCompatible implements PasswordCompatibleInterface
{
    public function isValid($input, $hashed, $salt, $static)
    {
        return $hashed == $this->createHash($input, $salt, $static);
    }

    public function createHash($input, $salt, $static = null)
    {
        // $static  =Engine_Api::_()->getApi('settings', 'core')->getSetting('core.secret', 'staticSalt');
        return md5($static . $input . $salt);
    }

    public function createSalt($length = 5)
    {
        return _random_string($length);
    }
}