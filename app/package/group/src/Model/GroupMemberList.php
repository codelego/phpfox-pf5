<?php

namespace Neutron\Group\Model;

use Phpfox\Db\DbModel;

class GroupMemberList extends DbModel
{
    public function getModelId()
    {
        return 'group_member_list';
    }

    public function getId()
    {
        return (int)$this->__get('list_id');
    }

    public function setId($value)
    {
        $this->__set('list_id', $value);
    }

    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function getTypeId()
    {
        return (int)$this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getMemberCount()
    {
        return (int)$this->__get('member_count');
    }

    public function setMemberCount($value)
    {
        $this->__set('member_count', $value);
    }

}