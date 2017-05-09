<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class I18nTimezone extends DbModel
{
    public function getModelId()
    {
        return 'i18n_timezone';
    }

    public function getId()
    {
        return $this->__get('timezone_id');
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

    public function getSortOrder()
    {
        return (int)$this->__get('sort_order');
    }

    public function setSortOrder($value)
    {
        $this->__set('sort_order', $value);
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

}