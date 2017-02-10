<?php

namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class UserVerification extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'user_verification';
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->__get('id');
    }

    /**
     * @param $value
     */
    public function setId($value)
    {
        $this->__set('id', (string)$value);
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    /**
     * @param $value
     */
    public function setUserId($value)
    {
        $this->__set('user_id', (int)$value);
    }

    /**
     * @param $value
     */
    public function setCreated($value)
    {
        return $this->__set('created', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getCreated()
    {
        return $this->__get('created');
    }

    /**
     * @return mixed|null
     */
    public function getExpiresAt()
    {
        return $this->__get('expires_at');
    }

    /**
     * @param $value
     */
    public function setExpiresAt($value)
    {
        return $this->__set('expires_at', $value);
    }
}