<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CorePermission extends DbModel
{
    public function getModelId()
    {
        return 'core_permission';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getLevelId()
    {
        return $this->__get('level_id');
    }

    public function setLevelId($value)
    {
        $this->__set('level_id', $value);
    }

    public function getGroupName()
    {
        return $this->__get('group_name');
    }

    public function setGroupName($value)
    {
        $this->__set('group_name', $value);
    }

    public function getActionName()
    {
        return $this->__get('action_name');
    }

    public function setActionName($value)
    {
        $this->__set('action_name', $value);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }
}