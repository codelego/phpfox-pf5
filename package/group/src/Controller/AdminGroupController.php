<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;

class AdminGroupController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Groups'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.group'), 'label' => _text('Groups')]);

        _service('menu.admin.secondary')->load('admin.group');

    }

    public function actionIndex()
    {

    }
}