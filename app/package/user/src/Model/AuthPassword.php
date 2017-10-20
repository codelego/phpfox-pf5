<?php

namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class AuthPassword extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'auth_password';
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
    public function getSourceId()
    {
        return $this->__get('source_id');
    }

    /**
     * @param $value
     */
    public function setSourceId($value)
    {
        $this->__set('source_id', (string)$value);
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
    public function getHashed()
    {
        return $this->__get('hashed');
    }

    /**
     * @param $value
     */
    public function setHashed($value)
    {
        $this->__set('hashed', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getSalt()
    {
        return $this->__get('salt');
    }

    /**
     * @param $value
     */
    public function setSalt($value)
    {
        $this->__set('salt', (string)$value);
    }

    /**
     * @return mixed|null
     */
    public function getStaticSalt()
    {
        return $this->__get('static_salt');
    }

    /**
     * @param $value
     */
    public function setStaticSalt($value)
    {
        $this->__set('static_salt', (string)$value);
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