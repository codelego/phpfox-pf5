<?php

namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class AuthPassword extends DbModel
{
    public function getModelId()
    {
        return 'auth_password';
    }

    public function getSourceId()
    {
        return $this->_data['source_id'];
    }

    public function getUserId()
    {
        return $this->_data['user_id'];
    }

    public function getHashed()
    {
        return $this->_data['hashed'];
    }

    public function getSalt()
    {
        return $this->_data['salt'];
    }

    public function getStaticSalt()
    {
        return $this->_data['static_salt'];
    }
}