<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\MailTemplate\AddMailTemplate;
use Neutron\Core\Form\Admin\MailTemplate\EditMailTemplate;
use Neutron\Core\Model\MailTemplate;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminMailTemplateController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')->set(_text('Mail Settings', 'menu'));

        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'menu'),
            ]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'mail');

        \Phpfox::get('menu.admin.buttons')->load('_core.mail.template.buttons');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => MailTemplate::class,
            'template' => 'core/admin-mail-template/index',
        ]))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => MailTemplate::class,
            'form'     => AddMailTemplate::class,
            'redirect' => _url('admin.core.mail.template'),
        ]))->process();
    }

    public function actionTranslate()
    {
        return new ViewModel([],'core/admin-mail-template/translate');
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'template_id',
            'model'    => MailTemplate::class,
            'form'     => EditMailTemplate::class,
            'redirect' => _url('admin.core.mail.template'),
        ]))->process();
    }

    public function actionDelete()
    {

    }
}