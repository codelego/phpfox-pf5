<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\LogDriver\SelectLogDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminLogController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'log';

    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.log'),
                'label' => _text('Log Settings', 'menu'),
            ]);

        _get('html.title')
            ->set(_text('Log Settings', 'menu'));

        _get('menu.admin.secondary')
            ->load('_core.log');
    }

    protected function afterDispatch($action)
    {
        _get('menu.admin.buttons')
            ->load('_core.log.buttons');
    }

    public function actionIndex()
    {
        $allLogs = [];

        $service = _get('core.adapter');
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
        return (new AdminSiteSettingsProcess(
            ['setting_group' => 'core_log',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _get('request');
        $containerId = $request->get('container_id');
        $driverId = $request->get('driver_id');

        $form = new SelectLogDriver();

        if ($containerId and $driverId) {
            _redirect('admin.core.log', [
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
        $request = _get('request');
        $driverId = $request->get('driver_id');

        $form = _get('core.adapter')
            ->getEditingForm($driverId, 'log');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = _model('core_adapter')
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

            _redirect('admin.core.log');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _get('request');
        $adapterId = $request->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = _model('core_adapter')
            ->findById($adapterId);

        $form = _get('core.adapter')->getEditingForm($adapterEntry->getDriverId(), self::DRIVER_TYPE);

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

            _redirect('admin.core.log');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $entry = _get('core.adapter')->getAdapterById(_get('request')->get('adapter_id'));

        $entry->delete();

        _redirect('admin.core.log');
    }

    public function actionEnable()
    {
        /** @var CoreAdapter $adapter */
        $adapter = _model('core_adapter')
            ->findById(_get('request')->get('adapter_id'));

        $adapter->setActive(1);
        $adapter->save();

        _trigger('onSettingChanges');

        _redirect('admin.core.log');
    }

    public function actionDisable()
    {
        /** @var CoreAdapter $adapter */
        $adapter = _model('core_adapter')
            ->findById(_get('request')->get('adapter_id'));

        $adapter->setActive(0);
        $adapter->save();

        _trigger('onSettingChanges');

        _redirect('admin.core.log');
    }
}