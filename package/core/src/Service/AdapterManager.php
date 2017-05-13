<?php

namespace Neutron\Core\Service;

use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Model\CoreDriver;
use Phpfox\Form\Form;

class AdapterManager
{
    /**
     * @param string $identity
     *
     * @return CoreAdapter
     */
    public function getAdapterById($identity)
    {
        return _model('core_adapter')
            ->findById($identity);
    }

    /**
     * @param string $driverId
     * @param string $driverType
     *
     * @return Form
     * @throws \Exception
     */
    public function getEditingForm($driverId, $driverType)
    {
        $coreDriver = $this->getDriver($driverId, $driverType);

        if (!$coreDriver) {
            throw new \Exception('Oop!, can not find driver');
        }

        $formSettingClass = $coreDriver->getFormSettingsClass();

        if (!class_exists($formSettingClass,true)) {
            throw new \Exception('Oop!, Can not find form edit settings ' . $formSettingClass);
        }

        return new $formSettingClass([]);
    }

    /**
     * @param string $driverType
     *
     * @return CoreDriver[]
     */
    public function getDriverIdOptions($driverType)
    {
        $select = _model('core_driver')
            ->select()
            ->where('driver_type=?', $driverType)
            ->where('is_active=?', 1)
            ->order('sort_order', 1);

        return array_map(function (CoreDriver $coreDriver) {
            return [
                'value' => $coreDriver->getDriverId(),
                'label' => $coreDriver->getTitle(),
                'note'  => $coreDriver->getDescription(),
            ];
        }, $select->all());
    }

    /**
     * @param string $driverId
     * @param string $driverType
     *
     * @return CoreDriver
     */
    public function getDriver($driverId, $driverType)
    {
        return _model('core_driver')
            ->select()
            ->where('driver_id=?', $driverId)
            ->where('driver_type=?', $driverType)
            ->first();
    }

    /**
     * @param string $identity
     *
     * @return CoreDriver
     */
    public function findDriverByIdentity($identity)
    {
        return _model('core_driver')
            ->findById($identity);
    }
}