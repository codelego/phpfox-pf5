<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class CoreJobDriver extends DbModel
{
    public function getModelId()
    {
        return 'core_job_driver';
    }

    public function getId()
    {
        return $this->__get('id');
    }

    public function setId($value)
    {
        $this->__set('id', $value);
    }

    public function getDriver()
    {
        return $this->__get('driver');
    }

    public function setDriver($value)
    {
        $this->__set('driver', $value);
    }

    public function getJsonConfigs()
    {
        return $this->__get('json_configs');
    }

    public function setJsonConfigs($value)
    {
        $this->__set('json_configs', $value);
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
}