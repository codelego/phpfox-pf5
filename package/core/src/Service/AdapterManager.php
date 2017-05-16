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

    public function getAdapterIdOptions($driverType)
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', $driverType)
            ->where('is_active=?', 1);

        return array_map(function (CoreAdapter $coreAdapter) {
            return [
                'value' => $coreAdapter->getId(),
                'label' => $coreAdapter->getTitle(),
                'note'  => $coreAdapter->getDescription(),
            ];
        }, $select->all());
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

        if (!class_exists($formSettingClass, true)) {
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
            ->order('ordering', 1);

        return array_map(function (CoreDriver $coreDriver) {
            $deps = $coreDriver->getDependency();
            $enable = true;
            $error = '';
            if ($deps) {
                list($enable, $error) = _get('package')
                    ->checkDependencies($deps);
            }

            if ($error) {
                $error = '<span class="text-danger">' . $error . '</span><br/>' . $coreDriver->getDescription();
            }
            return [
                'value'    => $coreDriver->getDriverId(),
                'label'    => $coreDriver->getTitle(),
                'note'     => $enable ? $coreDriver->getDescription() : $error,
                'disabled' => !$enable,
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