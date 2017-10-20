<?php

namespace Neutron\User\Model;

use Phpfox\Db\DbModel;

class FriendList extends DbModel
{
    public function getModelId()
    {
        return '';
    }

    public function getId()
    {
        return $this->__get('list_id');
    }

    public function setId($value)
    {
        $this->__set('list_id', $value);
    }

    public function getParentId()
    {
        return $this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function getTypeId()
    {
        return $this->__get('type_id');
    }

    public function setTypeId($value)
    {
        $this->__set('type_id', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

}