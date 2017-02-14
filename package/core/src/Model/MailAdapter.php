<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class MailAdapter extends DbModel
{
    public function getModelId()
    {
        return 'mail_adapter';
    }

    public function getId()
    {
        return (int)$this->__get('adapter_id');
    }

    public function setId($value)
    {
        $this->__set('adapter_id', $value);
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

    public function isFallback()
    {
        return $this->__get('is_fallback') ? 1 : 0;
    }

    public function setFallback($value)
    {
        $this->__set('is_fallback', $value ? 1 : 0);
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