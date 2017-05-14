<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminManageEntryProcess;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminSessionController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'session';

    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.session'),
                'label' => _text('Session Settings', 'menu'),
            ]);

        _service('html.title')
            ->set(_text('Session Settings', 'menu'));

        _service('menu.admin.secondary')
            ->load('admin.core.session');
    }

    protected function postDispatch($action)
    {
        _service('menu.admin.buttons')
            ->load('admin.core.session.buttons');
    }

    public function actionIndex()
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminManageEntryProcess([
            'select'   => $select,
            'template' => 'core/admin-session/manage-session-adapter',
            'data'     => ['defaultValue' => _param('core.default_session_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess(
            ['setting_group' => 'core_session',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _service('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectCoreDriver(['driverType' => self::DRIVER_TYPE]),
            ], 'layout/form-edit');
        }

        _redirect('admin.core.session', [
            'action'    => 'config',
            'driver_id' => $driverId,
        ]);
    }

    public function actionConfig()
    {
        $request = _service('request');
        $driverId = $request->get('driver_id', 'files');

        $form = _service('core.adapter')
            ->getEditingForm($driverId, 'session');

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
            $adapterEntry->setDriverType('session');
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.session');
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
        $adapterEntry = _model('core_adapter')->findById($adapterId);

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

            _redirect('admin.core.session');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDefault()
    {
        $identity = _service('request')
            ->get('adapter_id');

        /** @var CoreAdapter $entry */
        $entry = _model('core_adapter')->findById($identity);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "adapter_id"');
        }

        if (!$entry->isActive()) {
            $entry->setActive(1);
            $entry->save();
        }

        _service('core.setting')->updateValue('core.default_session_id', $identity);

        _service('session.local')->flush();

        _redirect('admin.core.session');
    }
}