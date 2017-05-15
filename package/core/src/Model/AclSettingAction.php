<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class AclSettingAction extends DbModel
{
    public function getModelId()
    {
        return 'acl_setting_action';
    }

    public function getActionId()
    {
        return (int)$this->__get('action_id');
    }

    public function getId()
    {
        return (int)$this->__get('action_id');
    }

    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

    public function setId($value)
    {
        $this->__set('action_id', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function getGroupId()
    {
        return $this->__get('group_id');
    }

    public function setGroupId($value)
    {
        $this->__set('group_id', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getOrdering()
    {
        return (int)$this->__get('ordering');
    }

    public function setOrdering($value)
    {
        $this->__set('ordering', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }
}