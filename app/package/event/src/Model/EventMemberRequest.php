<?php

namespace Neutron\Event\Model;

use Phpfox\Db\DbModel;

class EventMemberRequest extends DbModel
{
    public function getModelId()
    {
        return 'event_member_request';
    }

    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function getUserId()
    {
        return (int)$this->__get('user_id');
    }

    public function setUserId($value)
    {
        $this->__set('user_id', $value);
    }

    public function getStatusId()
    {
        return (int)$this->__get('status_id');
    }

    public function setStatusId($value)
    {
        $this->__set('status_id', $value);
    }

    public function getCreatedAt()
    {
        return $this->__get('created_at');
    }

    public function setCreatedAt($value)
    {
        $this->__set('created_at', $value);
    }

}