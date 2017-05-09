<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Events'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.event'), 'label' => _text('Events')]);

        _service('menu.admin.secondary')->load('admin.event');

    }

    public function actionIndex()
    {

    }
}