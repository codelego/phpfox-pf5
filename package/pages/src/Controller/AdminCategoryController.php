<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Pages'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.pages'), 'label' => _text('Pages')]);

        _service('menu.admin.secondary')->load('admin.pages');

    }

    public function actionIndex()
    {

    }
}