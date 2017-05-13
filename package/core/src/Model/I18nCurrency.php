<?php

namespace Neutron\Core\Model;

use Phpfox\Db\DbModel;

class I18nCurrency extends DbModel
{
    public function getModelId()
    {
        return 'i18n_currency';
    }

    public function getCurrencyId()
    {
        return $this->__get('currency_id');
    }

    public function getId()
    {
        return $this->__get('currency_id');
    }

    public function setCurrencyId($value)
    {
        $this->__set('currency_id', $value);
    }

    public function setId($value)
    {
        $this->__set('currency_id', $value);
    }

    public function getSymbol()
    {
        return $this->__get('symbol');
    }

    public function setSymbol($value)
    {
        $this->__set('symbol', $value);
    }

    public function getName()
    {
        return $this->__get('name');
    }

    public function setName($value)
    {
        $this->__set('name', $value);
    }

    public function getSortOrder()
    {
        return (int)$this->__get('sort_order');
    }

    public function setSortOrder($value)
    {
        $this->__set('sort_order', $value);
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