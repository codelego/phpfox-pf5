<?php

namespace Phpfox\Auth;


class MockAuthBaseExample implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $authResult = new AuthResult();

        if (!$identity) {
            $authResult->setResult(AuthResult::MISSING_IDENTITY);
            return $authResult;
        }

        if (!$credential) {
            $authResult->setResult(AuthResult::MISSING_CREDENTIAL);
            return $authResult;
        }

        if ($identity != 'jack') {
            $authResult->setResult(AuthResult::INVALID_IDENTITY);
            return $authResult;
        }

        if ($credential != 'jack123') {
            $authResult->setResult(AuthResult::INVALID_CREDENTIAL);
            return $authResult;
        }

        $authResult->setResult(AuthResult::SUCCESS);
        $authResult->setIdentity(1000);
        return $authResult;
    }
}