<?php

namespace Neutron\Photo\Controller;


use Neutron\Core\Controller\AdminController;

class AdminAclController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')->set(_text('Photos'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.photo'), 'label' => _text('Photos')]);

        _get('menu.admin.secondary')->load('admin.photo');
    }

    public function actionIndex()
    {

    }
}