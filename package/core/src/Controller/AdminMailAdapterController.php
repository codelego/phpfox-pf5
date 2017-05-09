<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\MailAdapter\TestEmailSettings;
use Neutron\Core\Form\SelectMailDriver;
use Neutron\Core\Model\MailAdapter;
use Neutron\Core\Model\MailDriver;
use Neutron\Core\Process\AdminManageEntryProcess;
use Phpfox\Form\Form;
use Phpfox\View\ViewModel;

class AdminMailAdapterController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'menu'),
            ]);

        _service('html.title')
            ->set(_text('Mail Settings', 'menu'));

        _service('menu.admin.secondary')
            ->load('admin.core.mail');
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'noLimit'  => true,
            'model'    => MailAdapter::class,
            'template' => 'core/admin-mail/manage-mail-adapter',
        ]))->process();
    }

    public function actionAdd()
    {
        $request = _service('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form' => new SelectMailDriver([]),
            ], 'layout/form-edit');
        }

        /** @var MailDriver $driver */
        $driver = _model('mail_driver')->findById($driverId);

        $formSettings = $driver->getFormName();

        $form = new $formSettings();

        return new ViewModel([
            'form' => new $form,
        ], 'layout/form-edit');

    }

    public function actionConfig()
    {
        $request = _service('request');
        $driverId = $request->get('driver_id', 'local');

        /** @var MailDriver $driverEntry */
        $driverEntry = _model('mail_driver')->findById($driverId);

        $formClass = $driverEntry->getFormName();

        /** @var Form $form */
        $form = new $formClass;

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var MailAdapter $adapterEntry */
            $adapterEntry = _model('storage_adapter')
                ->create([
                    'driver_id'  => $driverId,
                    'is_active'  => 0,
                    'is_default' => 0,
                ]);

            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();

            _redirect('admin.core.mail.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $adapterId = $request->get('adapter_id');

        /** @var MailAdapter $adapterEntry */
        $adapterEntry = _model('mail_adapter')->findById($adapterId);

        /** @var MailDriver $driverEntry */
        $driverEntry = _model('mail_driver')->findById($adapterEntry->getDriverId());

        $formClass = $driverEntry->getFormName();

        /** @var Form $form */
        $form = new $formClass([]);


        if ($request->isGet()) {
            $data = json_decode($adapterEntry->getParams(), true);
            $data = array_merge($data, $adapterEntry->toArray());
            $form->populate($data);
        } elseif ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $adapterEntry->fromArray($data);
            $adapterEntry->setParams(json_encode($data));
            $adapterEntry->save();
            _redirect('admin.core.mail.adapter');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionTest()
    {
        $req = _service('request');
        $form = new TestEmailSettings([]);

        if ($req->isGet()) {

        }

        if ($req->isPost() and $form->isValid($req->all())) {

        }

        return new ViewModel(['form' => $form], 'layout/form-edit');
    }

    /**
     * Set default adapter id
     * todo implement this method
     */
    public function actionDefault()
    {
        $request = _service('request');
        $adapterId = $request->get('adapter_id');

        _redirect('admin.core.mail.adapter');
    }
}