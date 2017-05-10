<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\I18nCurrency;
use Neutron\Core\Model\I18nLocale;
use Neutron\Core\Model\I18nTimezone;

class I18nManager
{
    public function getDirectionIdOptions()
    {
        return [
            ['value' => 'ltr', 'label' => 'Left to right'],
            ['value' => 'rtl', 'label' => 'Right to left'],
        ];
    }

    /**
     * @return array
     */
    public function getTimezoneIdOptions()
    {
        $select = _model('i18n_timezone')
            ->select()
            ->where('is_active=?', 1)
            ->order('sort_order', 1);
        return array_map(function (I18nTimezone $tz) {
            return [
                'value' => $tz->getTimezoneCode(),
                'label' => sprintf('(%s) %s', $tz->getTimezoneOffset(), $tz->getTimezoneLocation()),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getCurrencyIdOptions()
    {
        $select = _model('i18n_currency')
            ->select()
            ->order('sort_order', 1);

        return array_map(function (I18nCurrency $entry) {
            return [
                'label' => $entry->getName(),
                'value' => $entry->getId(),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getLocaleIdOptions()
    {
        $select = _model('i18n_locale')
            ->select()
            ->where('is_active=1');

        return array_map(function (I18nLocale $item) {
            return ['value' => $item->getId(), 'label' => $item->getNativeName()];
        }, $select->all());
    }
}