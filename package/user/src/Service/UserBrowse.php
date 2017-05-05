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
        return _model('user')
            ->findById($userId);
    }

    /**
     * @param $name
     *
     * @return User|mixed
     */
    public function findByProfileName($name)
    {
        return _model('user')
            ->select()
            ->where('username=?', (string)$name)
            ->execute()
            ->first();
    }
}