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
            $available = true;
            $error = '';

            if ($deps) {
                list($available, $error) = $this->checkDependencies($deps);
            }

            if ($error) {
                $error = '<span class="text-danger">' . $error . '</span><br/>' . $coreDriver->getDescription();
            }
            return [
                'value'    => $coreDriver->getDriverId(),
                'label'    => $coreDriver->getTitle(),
                'note'     => $available ? $coreDriver->getDescription() : $error,
                'disabled' => !$available,
            ];
        }, $select->all());
    }

    /**
     * @param array|string $deps
     *
     * @return array [available: true|false, error:string]
     */
    public function checkDependencies($deps)
    {
        $available = true;
        $error = '';

        if (is_string($deps)) {
            $deps = (array)json_decode($deps, true);
        }

        foreach ($deps as $dep) {
            switch ($dep['type']) {
                case 'function':
                    $available = function_exists($dep['value']);
                    break;
                case 'class':
                    $available = class_exists($dep['value']);
                    break;
                case 'extension':
                    $available = extension_loaded($dep['value']);
                    break;
                case 'service':
                    $available = _has($dep['value']);
                    break;
                case 'callback':
                    list($service, $method) = explode('::', $dep['value']);
                    if (!_has($service)
                        or !method_exists(_get($service), $method)
                        or !call_user_func([_get($service), $method])
                    ) {
                        $available = false;
                    }
                    break;
                default:
            }
            if (!$available) {
                $error = $dep['error'];
                break;
            }
        }

        return [$available, $error];
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