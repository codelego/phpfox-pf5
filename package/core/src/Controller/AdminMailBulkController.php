<?php

namespace Neutron\Core\Controller;

class AdminMailBulkController extends AdminController
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

    }
}