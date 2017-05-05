<?php

namespace Neutron\User\Auth;

use Neutron\User\Model\AuthRemote;
use Phpfox\Authentication\AuthInterface;
use Phpfox\Authentication\AuthResult;

class AuthByRemote implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();

        if (!$identity) {
            $result->setResult(AuthResult::MISSING_IDENTITY);
            return $result;
        }

        if (!$credential) {
            $result->setResult(AuthResult::MISSING_CREDENTIAL);
            return $result;
        }

        /** @var AuthRemote $remote */
        $remote = _with('auth_remote')
            ->select()
            ->where('remote_id=?', (string)$identity)
            ->where('remote_uid=?', (string)$credential)
            ->first();

        if (!$remote) {
            $result->setResult(AuthResult::INVALID_IDENTITY, null);
            return $result;
        }

        $userId = $remote->getUserId();

        if (!$userId) {
            // validate remote user id is exists
            $remote->delete();
            $result->setResult(AuthResult::INVALID_CREDENTIAL, null);
            return $result;
        }

        $user = \Phpfox::findById('user', $userId);

        if (!$user) {
            $remote->delete();
            $result->setResult(AuthResult::INVALID_CREDENTIAL, null);
            return $result;
        }

        $result->setIdentity($userId);
        $result->setResult(AuthResult::SUCCESS, null);
        return $result;
    }

}