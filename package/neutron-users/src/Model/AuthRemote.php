<?php

namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class AuthRemote extends DbModel
{
    public function getModelId()
    {
        return 'auth_remote';
    }

    public function getId()
    {
        return $this->_data['id'];
    }

    public function getUserId()
    {
        return $this->_data['user_id'];
    }
}