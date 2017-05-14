<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\CoreAdapter\SelectCoreDriver;
use Neutron\Core\Model\CoreAdapter;
use Neutron\Core\Process\AdminManageEntryProcess;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;
use Phpfox\View\ViewModel;

class AdminCaptchaController extends AdminController
{
    /**
     * @const DRIVER_TYPE string
     */
    const DRIVER_TYPE = 'captcha';

    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.captcha'),
                'label' => _text('Captcha Settings', 'menu'),
            ]);

        _get('html.title')
            ->set(_text('Captcha Settings', 'menu'));

        _get('menu.admin.secondary')
            ->load('admin.core.captcha');
    }

    protected function postDispatch($action)
    {
        _get('menu.admin.buttons')
            ->load('admin.core.captcha.buttons');
    }

    public function actionIndex()
    {
        $select = _model('core_adapter')
            ->select()
            ->where('driver_type=?', self::DRIVER_TYPE);

        return (new AdminManageEntryProcess([
            'select'   => $select,
            'template' => 'core/admin-captcha/manage-captcha-adapter',
            'data'     => ['defaultValue' => _param('core.default_captcha_id')],
        ]))->process();
    }

    public function actionSettings()
    {
        return (new AdminManageSiteSettingsProcess(
            ['setting_group' => 'core_captcha',]
        ))->process();
    }

    public function actionAdd()
    {
        $request = _get('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectCoreDriver(['driverType' => self::DRIVER_TYPE]),
            ], 'layout/form-edit');
        }

        _redirect('admin.core.captcha', [
            'action'    => 'config',
            'driver_id' => $driverId,
        ]);
    }

    public function actionConfig()
    {
        $request = _get('request');
        $driverId = $request->get('driver_id', 'files');

        $form = _get('core.adapter')
            ->getEditingForm($driverId, 'captcha');

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
            $adapterEntry->setDriverType('captcha');
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.captcha');
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

            _redirect('admin.core.captcha');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDefault()
    {
        $identity = _get('request')
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

        _get('core.setting')->updateValue('core.default_captcha_id', $identity);

        _get('captcha.local')->flush();

        _redirect('admin.core.captcha');
    }
}