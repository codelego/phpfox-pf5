<?php

namespace Neutron\Core\Service;


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
        return _service('core.adapter')
            ->getAdapterIdOptions(self::DRIVER_TYPE);
    }
}