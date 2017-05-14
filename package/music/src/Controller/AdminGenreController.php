<?php

namespace Neutron\Music\Controller;

use Neutron\Core\Controller\AdminController;

class AdminGenreController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Music'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.music'), 'label' => _text('Music')]);

        _get('menu.admin.secondary')->load('admin.music');

    }

    public function actionIndex()
    {

    }
}