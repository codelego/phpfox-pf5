<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Videos'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        _get('menu.admin.secondary')
            ->load('_video');
    }

    public function actionIndex()
    {

    }
}