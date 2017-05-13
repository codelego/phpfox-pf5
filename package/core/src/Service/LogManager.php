<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\CoreDriver;
use Neutron\Core\Model\LogAdapter;

class LogManager
{

    const  DRIVER_TYPE = 'log';

    /**
     * @return array
     */
    public function getContainerIdOptions()
    {
        return [
            [
                'value' => 'main_log',
                'label' => 'Main Log',
                'note'  => 'Log errors which raised from application domain',
            ],
            [
                'value' => 'mail_log',
                'label' => 'Mail Log',
                'note'  => 'Log errors which raised from email send domain',
            ],
            [
                'value' => 'debug_log',
                'label' => 'Debug Log',
                'note'  => 'Log from developer debug application',
            ],
        ];
    }

    /**
     * @param $containerId
     *
     * @return array
     */
    public function getAdapterIdOptions($containerId)
    {
        $select = _model('log_adapter')
            ->select()
            ->where('container_id=?', $containerId);

        return array_map(function (LogAdapter $entry) {
            return [
                'value' => $entry->getId(),
                'label' => $entry->getAdapterName(),
                'note'  => $entry->getDescription(),
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
}