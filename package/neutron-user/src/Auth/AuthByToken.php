<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\AuthInterface;
use Phpfox\Authentication\AuthResult;

class AuthByToken implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();

        $token = \Phpfox::getDb()
            ->select('*')
            ->from(':core_auth_token')
            ->where('id=?', $identity)
            ->limit(1, 0)
            ->execute()
            ->one();

        if (!$token) {
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        if (!$token['user_id']) { // delete dirty value
            $this->deleteDirtyToken($identity);
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        $userId = $token['user_id'];

        $user = \Phpfox::getDb()
            ->select('*')
            ->from(':user')
            ->where('user_id=?', $userId)
            ->limit(1, 0)
            ->execute()
            ->one();

        if (!$user) {
            $this->deleteDirtyToken($identity);
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        return $result;
    }

    /**
     * @param $identity
     */
    private function deleteDirtyToken($identity)
    {
        \Phpfox::getDb()
            ->delete(':core_auth_token')
            ->where('id=?', $identity)
            ->execute();
    }

}