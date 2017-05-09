<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\I18nLanguage;

class Languages
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
    public function getLanguageIdOptions()
    {
        $select = _model('i18n_language')
            ->select()
            ->where('is_active=1');

        return array_map(function (I18nLanguage $item) {
            return ['value' => $item->getId(), 'label' => $item->getNativeName()];
        }, $select->all());
    }
}