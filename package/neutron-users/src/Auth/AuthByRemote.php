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

        /** @var AuthRemote $remote */
        $remote = \Phpfox::getModel('auth_remote')
            ->select()
            ->where('remote_id=?', (string)$identity)
            ->where('remote_uid=?', (string)$credential)
            ->execute()
            ->first();

        if (!$remote) {
            $result->setResult(AuthResult::INVALID_CREDENTIAL, null);
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