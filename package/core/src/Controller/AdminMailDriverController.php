<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\MailDriver\AddMailDriver;
use Neutron\Core\Form\Admin\MailDriver\EditMailDriver;
use Neutron\Core\Model\MailDriver;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminMailDriverController extends AdminController
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
            'model'    => MailDriver::class,
            'template' => 'core/admin-mail/manage-mail-driver',
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'driver_id',
            'model'    => MailDriver::class,
            'form'     => EditMailDriver::class,
            'redirect' => _url('admin.core.mail.driver'),
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => MailDriver::class,
            'form'     => AddMailDriver::class,
            'redirect' => _url('admin.core.mail.driver'),
        ]))->process();
    }
}