<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;

class AdminGroupController extends AdminController
{
    protected function afterInitialize()
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