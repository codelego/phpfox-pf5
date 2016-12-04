<?php

namespace Neutron\User\Auth;


use Phpfox\Authentication\AuthInterface;
use Phpfox\Authentication\AuthResult;

class AuthByRemote implements AuthInterface
{
    public function authenticate($identity, $credential, $options = null)
    {
        $result = new AuthResult();

        $remote = \Phpfox::getDb()->select('*')
            ->from(':core_auth_remote')
            ->where('remote_id=?', (string)$identity)
            ->where('remote_uid=?', (string)$credential)
            ->execute()
            ->one();

        $remoteId = $remote['id'];

        if (!$remote) {
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        if (!$remote['user_id']) {
            // validate remote user id is exists
            $this->deleteDirtyRemote($remoteId);
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        $user = \Phpfox::getDb()
            ->select('*')
            ->from(':user')
            ->where('user_id=?', $remote['user_id'])
            ->limit(1, 0)
            ->execute()
            ->one();

        if (!$user) {
            $this->deleteDirtyRemote($remoteId);
            $result->setCode(AuthResult::INVALID_CREDENTIAL);
            return $result;
        }

        $result->setIdentity($remote['user_id']);
        $result->setCode(AuthResult::SUCCESS);
        return $result;
    }

    /**
     * @param $remoteId
     */
    private function deleteDirtyRemote($remoteId)
    {
        \Phpfox::getDb()
            ->delete(':core_auth_remote')
            ->where('id=?', $remoteId)
            ->execute();
    }

}