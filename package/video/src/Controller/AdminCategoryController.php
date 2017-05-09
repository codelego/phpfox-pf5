<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Videos'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        _service('menu.admin.secondary')
            ->load('admin.video');
    }

    public function actionIndex()
    {
        
    }
}