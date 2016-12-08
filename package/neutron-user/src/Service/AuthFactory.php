<?php
namespace Neutron\User\Service;


use Neutron\User\Auth\AuthByPassword;

class AuthFactory
{
    public function factory()
    {
        return new AuthByPassword();
    }
}