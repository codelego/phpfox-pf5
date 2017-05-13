<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class LogAdapter extends DbModel
{
    public function getModelId()
    {
        return 'log_adapter';
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

    public function getContainerId()
    {
        return $this->__get('container_id');
    }

    public function setContainerId($value)
    {
        $this->__set('container_id', $value);
    }

    public function getAdapterName()
    {
        return $this->__get('adapter_name');
    }

    public function setAdapterName($value)
    {
        $this->__set('adapter_name', $value);
    }

    public function getDriverId()
    {
        return $this->__get('driver_id');
    }

    public function setDriverId($value)
    {
        $this->__set('driver_id', $value);
    }

    public function getParams()
    {
        return $this->__get('params');
    }

    public function setParams($value)
    {
        $this->__set('params', $value);
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