<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CacheAdapter;
use Neutron\Core\Model\CacheDriver;

class CacheManager
{

    /**
     * @return array
     */
    public function getAdapterIdOptions()
    {
        $select = _model('cache_adapter')
            ->select()
            ->where('is_active=?', 1);

        return array_map(function (CacheAdapter $entry) {
            return [
                'value' => $entry->getId(),
                'label' => $entry->getAdapterName(),
                'note'  => $entry->getDescription(),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getDriverIdOptions()
    {
        $select = _model('cache_driver')
            ->select()
            ->where('is_active=?', 1);

        return array_map(function (CacheDriver $entry) {
            return [
                'value' => $entry->getId(),
                'label' => $entry->getDriverName(),
                'note'  => $entry->getDescription(),
            ];
        }, $select->all());
    }
}