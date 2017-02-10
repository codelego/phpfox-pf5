<?php

namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class AuthRemote extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'auth_remote';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @return mixed|null
     */
    public function getUserId()
    {
        return $this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getRemoteId()
    {
        return $this->__get('remote_id');
    }

    /**
     * @param $value
     */
    public function setRemoteId($value)
    {
        $this->__set('remote_id', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getRemoteUid()
    {
        return $this->__get('remote_uid');
    }

    /**
     * @param $value
     */
    public function setRemoteUid($value)
    {
        $this->__set('remote_uid', (string)$value);
    }

    /**
     * @param $value
     */
    public function setRemoteToken($value)
    {
        $this->__set('remote_token', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getRemoteToken()
    {
        return $this->__get('remote_token');
    }

    /**
     * @return mixed|null
     */
    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    /**
     * @param $value
     */
    public function setCreatedAt($value)
    {
        $this->__set('created_at', (string)$value);
    }
}