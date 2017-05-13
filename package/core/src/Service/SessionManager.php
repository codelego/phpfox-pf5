<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreDriver;

class SessionManager
{
    const DRIVER_TYPE = 'session';

    /**
     * @param string $name
     *
     * @return CoreDriver
     */
    public function findDriverByName($name)
    {
        return _model('core_driver')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE)
            ->where('driver_name=?', $name)
            ->first();
    }

    /**
     * @return array
     */
    public function getDriverIdOptions()
    {
        $select = _model('core_driver')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE)
            ->where('is_active=?', 1)
            ->order('sort_order', 1);

        return array_map(function (CoreDriver $entry) {
            return [
                'value' => $entry->getDriverName(),
                'label' => $entry->getTitle(),
                'note'  => $entry->getDescription(),
            ];
        }, $select->all());
    }

}