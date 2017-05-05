<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminIndexController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()
            ->set(_text('Dashboard', 'admin'));

    }

    /**
     * @return ViewModel
     */
    public function actionIndex()
    {
        _service('layouts')
            ->setPageName('core/admin-index/index');

        return new ViewModel([
        ], 'core/admin-index/index');
    }
}