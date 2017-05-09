<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()->add(_text('Groups'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.group'), 'label' => _text('Groups')]);

        _service('menu.admin.secondary')->load('admin.group');

    }

    public function actionIndex()
    {

    }
}