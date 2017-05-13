<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreDriver;

class CacheManager
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'cache';

    /**
     * @return array
     */
    public function getAdapterIdOptions()
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE)
            ->where('is_active=?', 1);

        return array_map(function (CoreDriver $entry) {
            return [
                'value' => $entry->getId(),
                'label' => $entry->getTitle(),
                'note'  => $entry->getDescription(),
            ];
        }, $select->all());
    }
}