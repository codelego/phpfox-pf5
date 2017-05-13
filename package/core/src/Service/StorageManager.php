<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\CoreDriver;
use Neutron\Core\Model\StorageAdapter;

class StorageManager
{
    const DRIVER_TYPE = 'storage';

    /**
     * @return array
     */
    public function getAdapterIdOptions()
    {
        $select = _model('storage_adapter')->select()
            ->where('is_active=?', 1);

        return array_map(function (StorageAdapter $adapter) {
            return [
                'value' => $adapter->getId(),
                'label' => $adapter->getAdapterName(),
                'note'  => $adapter->getDescription(),
            ];
        }, $select->all());
    }

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

    /**
     * @return array
     */
    public function getActiveIdOptions()
    {
        return [
            ['value' => 1, 'label' => 'Yes, files can be stored using this service',],
            ['value' => 0, 'label' => 'No, files can be retries only',],
        ];
    }

    /**
     * @return array
     */
    public function getS3RegionIdOptions()
    {
        return [
            ['value' => 'us-west-1', 'label' => 'United States (West)',],
            ['value' => 'us-east-1', 'label' => 'United States (East)',],
            ['value' => 'eu-west-1', 'label' => 'Europe (Ireland)',],
            ['value' => 'eu-west-1', 'label' => 'Asia Pacific (Singapore)',],
            ['value' => 'ap-northeast-1', 'label' => 'Asia Pacific (Japan)',],
        ];
    }
}