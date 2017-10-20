<?php

namespace Neutron\Core\Controller;


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

    }

    public function actionAdd()
    {

    }

    public function actionEdit()
    {

    }

    public function actionDelete()
    {

    }
}