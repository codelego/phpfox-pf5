<?php

namespace Neutron\Friend\Model;


use Phpfox\Db\DbModel;

class FriendForward extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'friend_forward';
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    /**
     * @return int
     */
    public function getFriendId()
    {
        return (int)$this->__get('friend_id');
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
    public function setFriendId($value)
    {
        $this->__set('friend_id', (int)$value);
    }
}