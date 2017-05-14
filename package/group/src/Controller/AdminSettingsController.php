<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Groups'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.group'), 'label' => _text('Groups')]);

        _get('menu.admin.secondary')->load('_group');

    }

    public function actionIndex()
    {

    }
}