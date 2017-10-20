<?php

namespace Neutron\Photo\Controller;


use Neutron\Core\Controller\AdminController;

class AdminAlbumController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')->set(_text('Photos'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.photo'), 'label' => _text('Photos')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'photo');
    }

    public function actionIndex()
    {

    }
}