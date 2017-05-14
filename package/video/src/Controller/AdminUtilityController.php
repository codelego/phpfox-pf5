<?php

namespace Neutron\Video\Controller;


use Neutron\Core\Controller\AdminController;

class AdminUtilityController extends AdminController
{
    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Videos'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        _get('menu.admin.secondary')
            ->load('_video');
    }

    public function actionIndex()
    {

    }
}