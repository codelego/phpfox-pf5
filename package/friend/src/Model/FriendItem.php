<?php

namespace Neutron\Friend\Model;

use Phpfox\Db\DbModel;

class FriendItem extends DbModel
{
    /**
     * @return string
     */
    public function getModelId()
    {
        return 'friend_item';
    }

    /**
     * @return mixed|null
     */
    public function getListId()
    {
        return $this->__get('list_id');
    }

    /**
     * @param $value
     */
    public function setListId($value)
    {
        $this->__set('list_id', (int)$value);
    }

    /**
     * @return mixed|null
     */
    public function getFriendId()
    {
        return $this->__get('friend_id');
    }

    /**
     * @param $value
     */
    public function setFriendId($value)
    {
        $this->__set('friend_id', (int)$value);
    }
}