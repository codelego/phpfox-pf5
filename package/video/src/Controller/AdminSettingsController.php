<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Videos'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        _get('menu.admin.secondary')
            ->load('admin.video');
    }

    public function actionIndex()
    {

    }
}