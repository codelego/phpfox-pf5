<?php

namespace Neutron\User\Model;

use Phpfox\Db\DbModel;

class AuthToken extends DbModel
{
    public function getModelId()
    {
        return 'auth_token';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

    public function getExpiresAt()
    {
        return $this->__get('expires_at');
    }

    public function setExpiresAt($value)
    {
        $this->__set('expires_at', $value);
    }

}