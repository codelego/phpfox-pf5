<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\AuthInterface;
use Phpfox\Authentication\AuthResult;

class AuthByToken implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();

        $token = \Phpfox::findById('auth_token', $identity);

        if (!$token) {
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        if (!$token['user_id']) { // delete dirty value
            $token->delete();
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        $userId = $token['user_id'];
        $user = \Phpfox::findById('user', $userId);

        if (!$user) {
            $token->delete();
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        return $result;
    }
}