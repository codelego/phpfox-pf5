<?php

namespace Neutron\Core\Controller;

class AdminMailBulkController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'menu'),
            ]);

        _get('html.title')
            ->set(_text('Mail Settings', 'menu'));

        _get('menu.admin.secondary')
            ->load('admin.core.mail');
    }

    public function actionIndex()
    {

    }
}