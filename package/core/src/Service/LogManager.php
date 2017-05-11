<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\LogAdapter;
use Neutron\Core\Model\LogDriver;

class LogManager
{

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
     * @return array
     */
    public function getDriverIdOptions()
    {
        $select = _model('log_driver')
            ->select()
            ->where('is_active=?', 1)
            ->order('sort_order', 1);

        return array_map(function (LogDriver $entry) {
            return [
                'value' => $entry->getId(),
                'label' => $entry->getDriverName(),
                'note'  => $entry->getDescription(),
            ];
        }, $select->all());
    }
}