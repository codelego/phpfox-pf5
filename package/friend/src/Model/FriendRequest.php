<?php

namespace Neutron\Friend\Model;


use Phpfox\Db\DbModel;

class FriendRequest extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'friend_request';
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
        $this->__set('id', (int)$value);
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
    public function getFriendId()
    {
        return (int)$this->__get('friend_id');
    }

    /**
     * @param $value
     */
    public function setFriendId($value)
    {
        $this->__set('friend_id', (int)$value);
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
        $this->__set('created_at', $value);
    }

    /**
     * @return mixed|null
     */
    public function getStatus()
    {
        return $this->__get('request_status');
    }

    /**
     * @param $value
     */
    public function setStatus($value)
    {
        $this->__set('request_status', $value);
    }
}