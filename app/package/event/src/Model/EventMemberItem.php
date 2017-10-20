<?php

namespace Neutron\Event\Model;

use Phpfox\Db\DbModel;

class EventMemberItem extends DbModel
{
    public function getModelId()
    {
        return 'event_member_item';
    }

    public function getId()
    {
        return (int)$this->__get('list_id');
    }

    public function setId($value)
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