<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\I18nCurrency;

class Currencies
{
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
}