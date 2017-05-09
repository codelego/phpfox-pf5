<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\StorageAdapter\AddStorageAdapter;
use Neutron\Core\Model\StorageAdapter;
use Neutron\Core\Model\StorageDriver;
use Neutron\Core\Process\AdminManageEntryProcess;
use Phpfox\Form\Form;
use Phpfox\View\ViewModel;

class AdminStorageAdapterController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Storage System', 'admin'));

        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage System', 'admin'),
            ]);

        _service('menu.admin.secondary')
            ->load('admin.core.storage');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')
                ->load('admin.core.storage.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'noLimit'  => true,
            'model'    => StorageAdapter::class,
            'template' => 'core/admin-storage/manage-storage-adapter',
        ]))->process();
    }

    public function actionAdd()
    {
        $request = _service('request');

        $form = new AddStorageAdapter([]);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();

            _redirect('admin.core.storage.adapter', [
                'action'    => 'config',
                'driver_id' => $data['driver_id'],
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

        /** @var StorageDriver $driverEntry */
        $driverEntry = _model('storage_driver')->findById($driverId);

        $formClass = $driverEntry->getFormName();

        /** @var Form $form */
        $form = new $formClass;

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var StorageAdapter $adapterEntry */
            $adapterEntry = _model('storage_adapter')
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

            _redirect('admin.core.storage.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $adapterId = $request->get('adapter_id');

        /** @var StorageAdapter $adapterEntry */
        $adapterEntry = _model('storage_adapter')->findById($adapterId);

        /** @var StorageDriver $driverEntry */
        $driverEntry = _model('storage_driver')->findById($adapterEntry->getDriverId());

        $formClass = $driverEntry->getFormName();

        /** @var Form $form */
        $form = new $formClass();

        if ($request->isGet()) {
            $data = json_decode($adapterEntry->getParams(), true);
            $data = array_merge($data, $adapterEntry->toArray());
            $form->populate($data);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var StorageAdapter $adapterEntry */
            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.storage.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}