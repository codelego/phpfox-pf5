<?php

namespace Neutron\Photo\Controller;


use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')->set(_text('Photos'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.photo'), 'label' => _text('Photos')]);

        _get('menu.admin.secondary')->load('_photo');
    }

    public function actionIndex()
    {

    }
}