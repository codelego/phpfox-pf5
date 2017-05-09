<?php

namespace Neutron\Poll\Controller;

use Neutron\Core\Controller\AdminController;

class AdminPollController extends AdminController
{

    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Polls'));

        _service('breadcrumb')
            ->set(['href' => _url('admin.poll'), 'label' => _text('Polls')]);

        _service('menu.admin.secondary')
            ->load('admin.poll');
    }


    public function actionIndex()
    {

    }
}