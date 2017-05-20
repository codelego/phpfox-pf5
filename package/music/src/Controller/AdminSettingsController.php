<?php

namespace Neutron\Music\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Music'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.music'), 'label' => _text('Music')]);

        _get('menu.admin.secondary')->load('_music');

    }

    public function actionIndex()
    {

    }
}