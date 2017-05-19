<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CacheDriver\SelectCacheDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Core\Process\AdminSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminCacheController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'cache';

    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.cache'),
                'label' => _text('Cache Settings', 'menu'),
            ]);

        _get('html.title')
            ->set(_text('Cache Settings', 'menu'));

        _get('menu.admin.secondary')
            ->load('_core.cache');
    }

    protected function afterDispatch($action)
    {
        _get('menu.admin.buttons')
            ->load('_core.cache.buttons');
    }

    public function actionIndex()
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminListEntryProcess([
            'select'   => $select,
            'template' => 'core/admin-cache/manage-cache-adapter',
            'data'     => ['defaultValue' => _param('core.default_cache_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminSiteSettingsProcess(
            ['setting_group' => 'core_cache',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _get('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectCacheDriver(),
            ], 'layout/form-edit');
        }

        _redirect('admin.core.cache', [
            'action'    => 'config',
            'driver_id' => $driverId,
        ]);
    }

    public function actionConfig()
    {
        $request = _get('request');
        $driverId = $request->get('driver_id', 'files');

        $form = _get('core.adapter')
            ->getEditingForm($driverId, 'cache');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {

            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = _model('core_adapter')
                ->create([
                    'driver_id'   => $driverId,
                    'driver_type' => self::DRIVER_TYPE,
                    'is_active'   => 0,
                ]);

            // how to get name
            $data = $form->getData();
            $adapterEntry->setDriverType('cache');
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.cache');
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
        $adapterEntry = _model('core_adapter')->findById($adapterId);

        $form = _get('core.adapter')
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

            _redirect('admin.core.cache');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $entry = _get('core.adapter')->getAdapterById(_get('request')->get('adapter_id'));

        $entry->delete();

        _redirect('admin.core.cache');
    }

    public function actionDefault()
    {
        $adapterId = _get('request')->get('adapter_id');

        $result = _get('core.adapter')->setDefaultAdapterById($adapterId);
        if ($result) {
            _get('core.setting')->updateValue('core.shared_cache_cache_id', $adapterId);
        }
        _redirect('admin.core.cache');
    }
}