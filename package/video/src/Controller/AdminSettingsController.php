<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;

class AdminSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()->add(_text('Videos'));

        _service('breadcrumb')
            ->clear()->add(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        _service('menu.admin.secondary')
            ->clear()
            ->load('admin.video');
    }

    public function actionIndex()
    {

    }
}