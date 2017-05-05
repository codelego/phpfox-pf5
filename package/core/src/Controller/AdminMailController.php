<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\SelectMailDriver;
use Neutron\Core\Model\MailAdapter;
use Neutron\Core\Model\MailDriver;
use Phpfox\Form\Form;
use Phpfox\View\ViewModel;

class AdminMailController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.mail'),
                'label' => 'Manage Adapters',
            ]);

        _service('menu.admin.secondary')
            ->clear()
            ->add([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Manage Adapter'),
            ])
            ->add([
                'href'  => _url('admin.core.mail.manage-template'),
                'label' => _text('Manage Templates'),
            ])
            ->add([
                'href'  => _url('admin.core.mail.add-adapter'),
                'label' => _text('Add Adapter'),
            ])
            ->add([
                'href'  => _url('admin.core.mail.add-template'),
                'label' => _text('Add Template'),
            ]);
    }

    public function actionIndex()
    {
        $items = _model('mail_adapter')
            ->select()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-mail/manage-adapter');
    }

    public function actionTransports()
    {
        $items = _model('mail_adapter')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-mail/transports');
    }

    public function actionAddAdapter()
    {
        $request = _service('request');
        $driverId = $request->get('driver_id');

        if (!$driverId) {
            return new ViewModel([
                'form'    => new SelectMailDriver([]),
                'heading' => 'Add Adapter',
            ], 'layout/form-edit');
        }

        /** @var MailDriver $driver */
        $driver = _model('mail_driver')->findById($driverId);

        $formSettings = $driver->getFormName();

        $form = new $formSettings();

        return new ViewModel([
            'form'    => new $form,
            'heading' => 'Add Adapter',
        ], 'layout/form-edit');

    }

    public function actionEditAdapter()
    {
        $request = _service('request');
        $id = $request->get('id');

        /** @var MailAdapter $item */
        $item = _model('mail_adapter')->findById($id);

        /** @var MailDriver $driver */
        $driver = _model('mail_driver')->findById($item->getDriverId());

        $formSettings = $driver->getFormName();

        /** @var Form $form */
        $form = new $formSettings();

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {

        }

        return new ViewModel([
            'form'    => new $form,
            'heading' => 'Edit Adapter Settings',
        ], 'layout/form-edit');
    }
}