<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\CoreDriver;
use Neutron\Core\Model\StorageAdapter;

class StorageManager
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'storage';

    public function getStorageLimitOptions()
    {
        if (file_exists($filename = PHPFOX_CONFIG_DIR . 'storage_limit.php')) {
            return include $filename;
        }

        return [
            ['value' => 0, 'label' => _text('Unlimited')],
            ['value' => 5242880, 'label' => '5Mb'],
            ['value' => 10485760, 'label' => '25Mb'],
            ['value' => 52428800, 'label' => '50Mb'],
            ['value' => 104857600, 'label' => '100Mb'],
            ['value' => 524288000, 'label' => '500Mb'],
            ['value' => 1073741824, 'label' => '1Gb'],
            ['value' => 2147483648, 'label' => '2Gb'],
            ['value' => 5368709120, 'label' => '5Gb'],
            ['value' => 10737418240, 'label' => '10Gb'],
            ['value' => 26843545600, 'label' => '25Gb'],
        ];
    }

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
        return _service('core.adapter')
            ->getDriverIdOptions(self::DRIVER_TYPE);
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