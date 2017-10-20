<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class I18nTimezone extends DbModel
{
    public function getModelId()
    {
        return 'i18n_timezone';
    }

    public function getTimezoneId()
    {
        return $this->__get('timezone_id');
    }

    public function getId()
    {
        return $this->__get('timezone_id');
    }

    public function setTimezoneId($value)
    {
        $this->__set('timezone_id', $value);
    }

    public function setId($value)
    {
        $this->__set('timezone_id', $value);
    }

    public function getTimezoneLocation()
    {
        return $this->__get('timezone_location');
    }

    public function setTimezoneLocation($value)
    {
        $this->__set('timezone_location', $value);
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

    public function getTimezoneCode()
    {
        return $this->__get('timezone_code');
    }

    public function setTimezoneCode($value)
    {
        $this->__set('timezone_code', $value);
    }

    public function getTimezoneOffset()
    {
        return $this->__get('timezone_offset');
    }

    public function setTimezoneOffset($value)
    {
        $this->__set('timezone_offset', $value);
    }

    public function isDefault()
    {
        return $this->__get('is_default') ? 1 : 0;
    }

    public function setDefault($value)
    {
        $this->__set('is_default', $value ? 1 : 0);
    }
}