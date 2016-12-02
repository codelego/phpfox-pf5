<?php
namespace Phpfox\Authentication;

interface AuthenticationAdapterInterface
{
    /**
     * @return AuthenticationResult
     */
    public function authenticate();
}