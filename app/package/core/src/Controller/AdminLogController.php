<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\LogDriver\SelectLogDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminEditSettingsProcess;
use Phpfox\View\ViewModel;

class AdminLogController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'log';

    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.log'),
                'label' => _text('Log Settings', 'menu'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('Log Settings', 'menu'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'log');
    }

    protected function afterDispatch($action)
    {
        \Phpfox::get('menu.admin.buttons')
            ->load('_core.log.buttons');
    }

    public function actionIndex()
    {
        $allLogs = [];

        $service = \Phpfox::get('core.adapter');
        $options = $service->getContainerIdOptions(self::DRIVER_TYPE);

        foreach ($options as $option) {
            $allLogs[$option['value']] = $service->getAdapterByContainerId(self::DRIVER_TYPE, $option['value']);
        }

        return new ViewModel([
            'allLogs' => $allLogs,
        ], 'core/admin-log/manage-log-adapter');
    }

    public function actionSettings()
    {
        return (new AdminEditSettingsProcess(
            ['form_id' => 'core_log',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');
        $containerId = $request->get('container_id');
        $driverId = $request->get('driver_id');

        $form = new SelectLogDriver();

        if ($containerId and $driverId) {
            \Phpfox::redirect('admin.core.log', [
                'action'       => 'config',
                'container_id' => $containerId,
                'driver_id'    => $driverId,
            ]);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionConfig()
    {
        $request = \Phpfox::get('request');
        $driverId = $request->get('driver_id');

        $form = \Phpfox::get('core.adapter')
            ->getEditingForm($driverId, 'log');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = \Phpfox::model('core_adapter')
                ->create([
                    'driver_id'   => $driverId,
                    'driver_type' => self::DRIVER_TYPE,
                    'is_required' => 0,
                    'is_active'   => 0,
                    'is_default'  => 0,
                ]);

            // how to get name
            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            \Phpfox::redirect('admin.core.log');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = \Phpfox::get('request');
        $adapterId = $request->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = \Phpfox::model('core_adapter')
            ->findById($adapterId);

        $form = \Phpfox::get('core.adapter')->getEditingForm($adapterEntry->getDriverId(), self::DRIVER_TYPE);

        if ($request->isGet()) {
            $data = json_decode($adapterEntry->getParams(), true);
            $data = array_merge($data, $adapterEntry->toArray());
            $form->populate($data);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            \Phpfox::redirect('admin.core.log');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $entry = \Phpfox::get('core.adapter')->getAdapterById(\Phpfox::get('request')->get('adapter_id'));

        $entry->delete();

        \Phpfox::redirect('admin.core.log');
    }

    public function actionEnable()
    {
        /** @var CoreAdapter $adapter */
        $adapter = \Phpfox::model('core_adapter')
            ->findById(\Phpfox::get('request')->get('adapter_id'));

        $adapter->setActive(1);
        $adapter->save();

        \Phpfox::trigger('onSettingChanges');

        \Phpfox::redirect('admin.core.log');
    }

    public function actionDisable()
    {
        /** @var CoreAdapter $adapter */
        $adapter = \Phpfox::model('core_adapter')
            ->findById(\Phpfox::get('request')->get('adapter_id'));

        $adapter->setActive(0);
        $adapter->save();

        \Phpfox::trigger('onSettingChanges');

        \Phpfox::redirect('admin.core.log');
    }
}