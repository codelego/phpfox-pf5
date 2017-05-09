<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()->add(_text('Events'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.event'), 'label' => _text('Events')]);

        _service('menu.admin.secondary')->load('admin.event');

    }

    public function actionIndex()
    {

    }
}