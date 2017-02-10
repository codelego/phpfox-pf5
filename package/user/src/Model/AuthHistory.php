<?php

namespace Neutron\User\Model;

use Phpfox\Db\DbModel;

class AuthHistory extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'auth_history';
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
    public function getDeviceName()
    {
        return $this->__get('device_name');
    }

    /**
     * @param $value
     */
    public function setDeviceName($value)
    {
        $this->__set('device_name', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getRemoteAddress()
    {
        return $this->__get('remote_address');
    }


    /**
     * @param $value
     */
    public function setRemoteAddress($value)
    {
        $this->__set('remote_address', (string)$value);
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