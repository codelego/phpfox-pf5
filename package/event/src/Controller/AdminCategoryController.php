<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Events'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.event'), 'label' => _text('Events')]);

        _get('menu.admin.secondary')->load('_event');

    }

    public function actionIndex()
    {

    }
}