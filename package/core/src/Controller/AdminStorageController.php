<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;
use Neutron\Core\Model\StorageAdapter;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Core\Process\AdminSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminStorageController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Storage System', 'admin'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage System', 'admin'),
            ]);

        _get('menu.admin.secondary')
            ->load('_core.storage');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')
                ->load('_core.storage.buttons');
        }
    }

    public function actionSettings()
    {
        return (new AdminSiteSettingsProcess([
            'setting_group' => 'core_storage',
        ]))->process();
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'noLimit'  => true,
            'model'    => StorageAdapter::class,
            'data'     => ['defaultValue' => _param('core.default_storage_id')],
            'template' => 'core/admin-storage/manage-storage-adapter',
        ]))->process();
    }

    public function actionAdd()
    {
        $request = _get('request');

        $form = new SelectCoreDriver(['driverType' => 'storage']);

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
        $request = _get('request');
        $driverId = $request->get('driver_id', 'local');

        $form = _get('core.adapter')
            ->getEditingForm($driverId, 'storage');

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
        $request = _get('request');
        $adapterId = $request->get('adapter_id');

        /** @var StorageAdapter $adapterEntry */
        $adapterEntry = _model('storage_adapter')->findById($adapterId);

        $form = _get('core.adapter')
            ->getEditingForm($adapterEntry->getDriverId(), 'storage');

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

    public function actionDefault()
    {
        $identity = _get('request')
            ->get('adapter_id');

        /** @var StorageAdapter $entry */
        $entry = _model('storage_adapter')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "adapter_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(1);
            $entry->save();
        }

        _get('core.setting')->updateValue('core.default_storage_id', $identity);

        _get('shared.cache')->flush();

        _redirect('admin.core.storage.adapter');
    }
}