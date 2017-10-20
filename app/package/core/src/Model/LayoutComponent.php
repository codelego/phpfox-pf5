<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutComponent extends DbModel
{
    public function getModelId()
    {
        return 'layout_component';
    }

    public function getComponentId()
    {
        return $this->__get('component_id');
    }

    public function getId()
    {
        return $this->__get('component_id');
    }

    public function setComponentId($value)
    {
        $this->__set('component_id', $value);
    }

    public function setId($value)
    {
        $this->__set('component_id', $value);
    }

    public function getComponentName()
    {
        return $this->__get('component_name');
    }

    public function setComponentName($value)
    {
        $this->__set('component_name', $value);
    }

    public function getComponentClass()
    {
        return $this->__get('component_class');
    }

    public function setComponentClass($value)
    {
        $this->__set('component_class', $value);
    }

    public function getPackageId()
    {
        return $this->__get('package_id');
    }

    public function setPackageId($value)
    {
        $this->__set('package_id', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function getOrdering()
    {
        return (int)$this->__get('ordering');
    }

    public function setOrdering($value)
    {
        $this->__set('ordering', $value);
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