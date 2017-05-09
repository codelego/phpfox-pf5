<?php

namespace Neutron\Music\Controller;

use Neutron\Core\Controller\AdminController;

class AdminAclController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()->add(_text('Music'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.music'), 'label' => _text('Music')]);

        _service('menu.admin.secondary')->load('admin.music');

    }

    public function actionIndex()
    {

    }
}