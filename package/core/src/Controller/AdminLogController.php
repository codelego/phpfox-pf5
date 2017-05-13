<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Model\LogAdapter;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminLogController extends AdminController
{
    const DRIVER_TYPE = 'log';

    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.log'),
                'label' => _text('Log Settings', 'menu'),
            ]);

        _service('html.title')
            ->set(_text('Log Settings', 'menu'));

        _service('menu.admin.secondary')
            ->load('admin.core.log');
    }

    protected function postDispatch($action)
    {
        _service('menu.admin.buttons')
            ->load('admin.core.log.buttons');
    }

    public function actionIndex()
    {
        $allLogs = [];
        $titles = [
            'main.log'  => 'Main Logs',
            'mail.log'  => 'Mail Logs',
            'debug.log' => 'Debug Logs',
        ];
        foreach (['main.log', 'mail.log', 'debug.log'] as $containerId) {
            $allLogs[$containerId] = _model('log_adapter')
                ->select()
                ->where('container_id=?', $containerId)
                ->all();
        }

        return new ViewModel([
            'allLogs' => $allLogs,
            'titles'  => $titles,
        ], 'core/admin-log/manage-log-adapter');
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess(
            ['setting_group' => 'core_log',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _service('request');
        $containerId = $request->get('container_id');
        $driverId = $request->get('driver_id');

        $form = new SelectCoreDriver(['driverType' => self::DRIVER_TYPE]);

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
        $request = _service('request');
        $driverId = $request->get('driver_id', 'local');

        $form = _service('core.adapter')
            ->getEditingForm($driverId, 'log');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LogAdapter $adapterEntry */
            $adapterEntry = _model('log_adapter')
                ->create([
                    'driver_id'  => $driverId,
                    'is_active'  => 0,
                    'is_default' => 0,
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
        $request = _service('request');
        $adapterId = $request->get('adapter_id');

        /** @var CoreAdapter $adapterEntry */
        $adapterEntry = _model('log_adapter')
            ->findById($adapterId);

        $form = _service('core.adapter')
            ->getEditingForm($adapterEntry->getDriverId(), self::DRIVER_TYPE);

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

    public function actionEnable()
    {
        _redirect('admin.core.log');
    }

    public function actionDisable()
    {
        _redirect('admin.core.log');
    }
}