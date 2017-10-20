<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreAdapter extends DbModel
{
    public function getModelId()
    {
        return 'core_adapter';
    }

    public function getAdapterId()
    {
        return (int)$this->__get('adapter_id');
    }

    public function getId()
    {
        return (int)$this->__get('adapter_id');
    }

    public function setAdapterId($value)
    {
        $this->__set('adapter_id', $value);
    }

    public function setId($value)
    {
        $this->__set('adapter_id', $value);
    }

    public function getDriverType()
    {
        return $this->__get('driver_type');
    }

    public function setDriverType($value)
    {
        $this->__set('driver_type', $value);
    }

    public function getDriverId()
    {
        return $this->__get('driver_id');
    }

    public function setDriverId($value)
    {
        $this->__set('driver_id', $value);
    }

    public function isActive()
    {
        return $this->__get('is_active') ? 1 : 0;
    }

    public function setActive($value)
    {
        $this->__set('is_active', $value ? 1 : 0);
    }

    public function isDefault()
    {
        return $this->__get('is_default') ? 1 : 0;
    }

    public function setDefault($value)
    {
        $this->__set('is_default', $value ? 1 : 0);
    }

    public function isRequired()
    {
        return $this->__get('is_required') ? 1 : 0;
    }

    public function setRequired($value)
    {
        $this->__set('is_required', $value ? 1 : 0);
    }

    public function getContainerId()
    {
        return $this->__get('container_id');
    }

    public function setContainerId($value)
    {
        $this->__set('container_id', $value);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
    }

    public function getTitle()
    {
        return $this->__get('title');
    }

    public function setTitle($value)
    {
        $this->__set('title', $value);
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