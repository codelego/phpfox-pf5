<?php
namespace Neutron\User\Model;


use Phpfox\Db\DbModel;

class AuthToken extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'auth_token';
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
     * @return mixed|null
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

    /**
     * @return int
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
        $this->__set('expires_at', $value);
    }
}