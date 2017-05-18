<?php

namespace Neutron\Core\Service;


use Neutron\Core\Model\LogAdapter;

class LogManager
{
    /**
     * @const DRIVER_TYPE string
     */
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
     * Get list of log container id
     *
     * @return array
     */
    public function getLogContainerIds()
    {
        return array_map(function ($row) {
            return $row['container_id'];
        }, _model('log_adapter')
            ->select('distinct container_id as container_id')
            ->setPrototype(null)
            ->all());
    }

    /**
     * @return array
     */
    public function getLogLevelOptions()
    {
        return [
            ['value' => 'emergency', 'label' => 'Emergency'],
            ['value' => 'alert', 'label' => 'Alert'],
            ['value' => 'critical', 'label' => 'Critical'],
            ['value' => 'error', 'label' => 'Error'],
            ['value' => 'warning', 'label' => 'Warning'],
            ['value' => 'notice', 'label' => 'Notice'],
            ['value' => 'info', 'label' => 'Info'],
            ['value' => 'debug', 'label' => 'Debug'],
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
                'label' => $entry->getTitle(),
                'note'  => $entry->getDescription(),
            ];
        }, $select->all());
    }

    /**
     * @return array
     */
    public function getDriverIdOptions()
    {
        return _get('core.adapter')->getDriverIdOptions(self::DRIVER_TYPE);
    }
}