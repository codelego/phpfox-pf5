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
    public function getCreated()
    {
        return (int)$this->__get('created');
    }

    /**
     * @param $value
     */
    public function setCreated($value)
    {
        $this->__set('created', (string)$value);
    }

    /**
     * @return int
     */
    public function getLifetime()
    {
        return (int)$this->__get('lifetime');
    }

    /**
     * @param $value
     */
    public function setLifetime($value)
    {
        $this->__set('lifetime', (int)$value);
    }
}