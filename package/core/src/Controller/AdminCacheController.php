<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CacheAdapter\AddCacheAdapter;
use Neutron\Core\Model\CacheAdapter;
use Neutron\Core\Model\CacheDriver;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Neutron\Core\Process\AdminManageEntryProcess;
use Phpfox\Form\Form;
use Phpfox\View\ViewModel;

class AdminCacheController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.cache'),
                'label' => _text('Cache Settings', 'menu'),
            ]);

        _service('html.title')
            ->set(_text('Cache Settings', 'menu'));

        _service('menu.admin.secondary')
            ->load('admin.core.cache');
    }

    protected function postDispatch($action)
    {
        _service('menu.admin.buttons')
            ->load('admin.core.cache.buttons');
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'model'    => CacheAdapter::class,
            'template' => 'core/admin-cache/manage-cache-adapter',
            'data'     => ['defaultValue' => _param('core.default_cache_id')],
        ]))->process();
    }

    public function actionDriver()
    {
        return (new AdminManageEntryProcess([
            'model'    => CacheDriver::class,
            'template' => 'core/admin-cache/manage-cache-driver',
            'data'     => ['defaultValue' => _param('core.default_cache_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess(
            ['setting_group' => 'core_cache',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _service('request');

        $form = new AddCacheAdapter([]);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();

            _redirect('admin.core.cache', [
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

        /** @var CacheDriver $driverEntry */
        $driverEntry = _model('cache_driver')->findById($driverId);

        $formClass = $driverEntry->getFormName();

        /** @var Form $form */
        $form = new $formClass;

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var CacheAdapter $adapterEntry */
            $adapterEntry = _model('cache_adapter')
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

            _redirect('admin.core.cache');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $adapterId = $request->get('adapter_id');

        /** @var CacheAdapter $adapterEntry */
        $adapterEntry = _model('cache_adapter')->findById($adapterId);

        /** @var CacheDriver $driverEntry */
        $driverEntry = _model('cache_driver')->findById($adapterEntry->getDriverId());

        $formClass = $driverEntry->getFormName();

        /** @var Form $form */
        $form = new $formClass();

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

    public function actionDefault()
    {
        $identity = _service('request')
            ->get('adapter_id');

        /** @var CacheAdapter $entry */
        $entry = _model('cache_adapter')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "adapter_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(1);
            $entry->save();
        }

        _service('core.setting')->updateValue('core.default_cache_id', $identity);

        _service('cache.local')->flush();

        _redirect('admin.core.cache');
    }
}