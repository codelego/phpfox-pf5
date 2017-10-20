<?php

namespace Neutron\User\Auth;


use Neutron\User\Model\AuthToken;
use Phpfox\Auth\AuthInterface;
use Phpfox\Auth\AuthResult;

class AuthByToken implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();

        if (!$identity) {
            $result->setResult(AuthResult::MISSING_IDENTITY);
            return $result;
        }

        /** @var AuthToken $token */
        $token = \Phpfox::find('auth_token', $identity);

        if (!$token) {
            $result->setResult(AuthResult::INVALID_IDENTITY, null);
            return $result;
        }

        if (!$token->getUserId()) { // delete dirty value
            $token->delete();
            $result->setResult(AuthResult::INVALID_IDENTITY, null);
            return $result;
        }

        $user = \Phpfox::find('user', $token['user_id']);

        if (!$user) {
            $token->delete();
            $result->setResult(AuthResult::INVALID_IDENTITY, null);
            return $result;
        }

        $result->setResult(AuthResult::SUCCESS);
        $result->setIdentity($user->getId());

        return $result;
    }
}