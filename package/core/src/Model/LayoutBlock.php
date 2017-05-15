<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LayoutBlock extends DbModel
{
    public function getModelId()
    {
        return 'layout_block';
    }

    public function getBlockId()
    {
        return (int)$this->__get('block_id');
    }

    public function getId()
    {
        return (int)$this->__get('block_id');
    }

    public function setBlockId($value)
    {
        $this->__set('block_id', $value);
    }

    public function setId($value)
    {
        $this->__set('block_id', $value);
    }

    public function getParentId()
    {
        return (int)$this->__get('parent_id');
    }

    public function setParentId($value)
    {
        $this->__set('parent_id', $value);
    }

    public function getContainerId()
    {
        return (int)$this->__get('container_id');
    }

    public function setContainerId($value)
    {
        $this->__set('container_id', $value);
    }

    public function getLocationId()
    {
        return $this->__get('location_id');
    }

    public function setLocationId($value)
    {
        $this->__set('location_id', $value);
    }

    public function getComponentId()
    {
        return $this->__get('component_id');
    }

    public function setComponentId($value)
    {
        $this->__set('component_id', $value);
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

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }
}