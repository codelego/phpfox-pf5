<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\StorageDriver;

class StorageManager
{
    /**
     * @return array
     */
    public function getDriverIdOptions()
    {
        $select = _model('storage_driver')
            ->select()
            ->where('is_active=?', 1);

        return array_map(function (StorageDriver $item) {
            return [
                'value' => $item->getId(),
                'label' => $item->getDriverName(),
                'note'  => $item->getDescription(),
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