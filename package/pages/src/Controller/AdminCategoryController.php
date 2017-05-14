<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Pages'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.pages'), 'label' => _text('Pages')]);

        _get('menu.admin.secondary')->load('admin.pages');

    }

    public function actionIndex()
    {

    }
}