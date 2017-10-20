<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CacheDriver\SelectCacheDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminEditSettingsProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminCacheController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'cache';

    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.cache'),
                'label' => _text('Cache Settings', 'menu'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('Cache Settings', 'menu'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'cache');
    }

    protected function afterDispatch($action)
    {
        \Phpfox::get('menu.admin.buttons')
            ->load('_core.cache.buttons');
    }

    public function actionIndex()
    {
        $select = \Phpfox::model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminListEntryProcess([
            'select'   => $select,
            'template' => 'core/admin-cache/manage-cache-adapter',
            'data'     => ['defaultValue' => \Phpfox::setting('core.default_cache_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminEditSettingsProcess(['form_id' => 'core_cache',]))->process();
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectCacheDriver(),
            ], 'layout/form-edit');
        }

        \Phpfox::redirect('admin.core.cache', [
            'action'    => 'config',
            'driver_id' => $driverId,
        ]);
    }

    public function actionConfig()
    {
        $request = \Phpfox::get('request');
        $driverId = $request->get('driver_id', 'files');

        $form = \Phpfox::get('core.adapter')
            ->getEditingForm($driverId, 'cache');

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {

            /** @var CoreAdapter $adapterEntry */
            $adapterEntry = \Phpfox::model('core_adapter')
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

            \Phpfox::redirect('admin.core.cache');
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
        $adapterEntry = \Phpfox::model('core_adapter')->findById($adapterId);

        $form = \Phpfox::get('core.adapter')
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

            \Phpfox::redirect('admin.core.cache');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $entry = \Phpfox::get('core.adapter')->getAdapterById(\Phpfox::get('request')->get('adapter_id'));

        $entry->delete();

        \Phpfox::redirect('admin.core.cache');
    }

    public function actionDefault()
    {
        $adapterId = \Phpfox::get('request')->get('adapter_id');

        $result = \Phpfox::get('core.adapter')->setDefaultAdapterById($adapterId);
        if ($result) {
            \Phpfox::get('core.setting')->updateValue('core.shared_cache_cache_id', $adapterId);
        }
        \Phpfox::redirect('admin.core.cache');
    }
}