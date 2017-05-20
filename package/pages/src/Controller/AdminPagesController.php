<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;

class AdminPagesController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Pages'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.pages'), 'label' => _text('Pages')]);

        _get('menu.admin.secondary')->load('_pages');

    }

    public function actionIndex()
    {

    }
}