<?php
namespace Phpfox\Auth;

interface AuthAdapterInterface
{
    /**
     * @return AuthResult
     */
    public function authenticate();
}