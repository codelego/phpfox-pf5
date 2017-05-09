<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\I18nTimezone;

class Timezones
{
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
}