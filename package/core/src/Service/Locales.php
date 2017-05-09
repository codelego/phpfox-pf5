<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\I18nLocale;

class Locales
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