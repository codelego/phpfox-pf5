<?php

namespace Neutron\Music\Controller;

use Neutron\Core\Controller\AdminController;

class AdminAlbumController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Music'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.music'), 'label' => _text('Music')]);

        _service('menu.admin.secondary')->load('admin.music');

    }

    public function actionIndex()
    {

    }
}