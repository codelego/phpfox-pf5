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
        return (int)$this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getRemoteId()
    {
        return $this->__get('remote_id');
    }

    public function setRemoteId($value)
    {
        $this->__set('remote_id', $value);
    }

    public function getRemoteUid()
    {
        return (int)$this->__get('remote_uid');
    }

    public function setRemoteUid($value)
    {
        $this->__set('remote_uid', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getRemoteToken()
    {
        return $this->__get('remote_token');
    }

    public function setRemoteToken($value)
    {
        $this->__set('remote_token', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

}