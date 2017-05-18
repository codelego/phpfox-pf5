<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\SmsDriver\SelectSmsDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Core\Process\AdminSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminSmsController extends AdminController
{
    /**``
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'sms';

    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.sms'),
                'label' => _text('Verify Service Settings', 'menu'),
            ]);

        _get('html.title')
            ->set(_text('Mobile Service Settings', 'menu'));

        _get('menu.admin.secondary')
            ->load('_core.sms');
    }

    protected function afterDispatch($action)
    {
        _get('menu.admin.buttons')
            ->load('_core.sms.buttons');
    }

    public function actionIndex()
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminListEntryProcess([
            'select'   => $select,
            'template' => 'core/admin-sms/manage-sms-adapter',
            'data'     => ['defaultValue' => _param('core.default_sms_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminSiteSettingsProcess(
            ['setting_group' => 'core_sms',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _get('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectSmsDriver(),
            ], 'layout/form-edit');
        }

        _redirect('admin.core.sms', [
            'action'    => 'config',
            'driver_id' => $driverId,
        ]);
    }

    public function actionConfig()
    {
        $request = _get('request');
        $driverId = $request->get('driver_id', 'files');

        $form = _get('core.adapter')
            ->getEditingForm($driverId, 'sms');

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
            $adapterEntry->setDriverType('sms');
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.sms');
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

            _redirect('admin.core.sms');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDefault()
    {
        $adapterId = _get('request')
            ->get('adapter_id');

        /** @var CoreAdapter $entry */
        $entry = _model('core_adapter')->findById($adapterId);

        if (!$entry) {
            throw new \InvalidArgumentException('Invalid params "adapter_id"');
        }

        if (!$entry->isDefault()) {
            _model('core_adapter')
                ->update()
                ->values(['is_default' => 0])
                ->where('adapter_id <> ?', $adapterId)
                ->where('driver_type = ?', self::DRIVER_TYPE)
                ->execute();

            $entry->setDefault(1);
            $entry->setActive(1);
            $entry->save();

            _get('core.setting')->updateValue('core.default_sms_id', $adapterId);
        }

        _redirect('admin.core.sms');
    }
}