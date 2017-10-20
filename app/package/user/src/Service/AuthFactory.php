<?php

namespace Neutron\User\Service;


use Neutron\User\Auth\AuthByPassword;

class AuthFactory
{
    public function factory($id)
    {
        if (!$id) {
            ;
        }
        return new AuthByPassword();
    }
}