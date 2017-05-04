<?php

namespace Phpfox\Authentication;

interface AuthInterface
{
    /**
     * @param string $identity
     * @param string $credential
     * @param null   $options
     *
     * @return AuthResult
     */
    public function authenticate($identity, $credential, $options = null);
}