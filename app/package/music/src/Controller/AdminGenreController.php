<?php

namespace Neutron\Music\Controller;

use Neutron\Core\Controller\AdminController;

class AdminGenreController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Music'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.music'), 'label' => _text('Music')]);

        \Phpfox::get('menu.admin.secondary')->load('_music');

    }

    public function actionIndex()
    {

    }
}