<?php

namespace Neutron\Poll\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{

    protected function initialized()
    {
        _get('html.title')
            ->set(_text('Polls'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.poll'), 'label' => _text('Polls')]);

        _get('menu.admin.secondary')
            ->load('_poll');
    }


    public function actionIndex()
    {

    }
}