<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutAction extends DbModel
{
    public function getModelId()
    {
        return 'layout_action';
    }

    public function getActionId()
    {
        return $this->__get('action_id');
    }

    public function getId()
    {
        return $this->__get('action_id');
    }

    public function setActionId($value)
    {
        $this->__set('action_id', $value);
    }

    public function setId($value)
    {
        $this->__set('action_id', $value);
    }

    public function getParentActionId()
    {
        return $this->__get('parent_action_id');
    }

    public function setParentActionId($value)
    {
        $this->__set('parent_action_id', $value);
    }

    public function getActionName()
    {
        return $this->__get('action_name');
    }

    public function setActionName($value)
    {
        $this->__set('action_name', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function isAdmin()
    {
        return $this->__get('is_admin') ? 1 : 0;
    }

    public function setAdmin($value)
    {
        $this->__set('is_admin', $value ? 1 : 0);
    }

    public function getDescription()
    {
        return $this->__get('description');
    }

    public function setDescription($value)
    {
        $this->__set('description', $value);
    }
}