<?php

namespace Neutron\Friend\Model;

use Phpfox\Db\DbModel;

class FriendItem extends DbModel
{
    public function getModelId()
    {
        return 'friend_item';
    }

    public function getListId()
    {
        return (int)$this->__get('list_id');
    }

    public function setListId($value)
    {
        $this->__set('list_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }
}