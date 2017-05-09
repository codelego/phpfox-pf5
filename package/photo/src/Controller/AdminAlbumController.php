<?php

namespace Neutron\Photo\Controller;


use Neutron\Core\Controller\AdminController;

class AdminAlbumController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')->set(_text('Photos'));

        _service('breadcrumb')
            ->clear()->add(['href' => _url('admin.photo'), 'label' => _text('Photos')]);

        _service('menu.admin.secondary')->load('admin.photo');
    }

    public function actionIndex()
    {

    }
}