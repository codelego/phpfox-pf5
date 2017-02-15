<?php

namespace Neutron\User\Service;

use Neutron\User\Model\User;

class UserBrowse
{
    /**
     * @param $userId
     *
     * @return User|mixed
     */
    public function findUserById($userId)
    {
        return \Phpfox::with('user')
            ->findById($userId);
    }

    /**
     * @param $name
     *
     * @return User|mixed
     */
    public function findByProfileName($name)
    {
        return \Phpfox::with('user')
            ->select()
            ->where('username=?', (string)$name)
            ->execute()
            ->first();
    }
}