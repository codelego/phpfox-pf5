<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminIndexController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Dashboard', 'admin'));

    }

    /**
     * @return ViewModel
     */
    public function actionIndex()
    {
        _get('layouts')
            ->setPageName('core/admin-index/index');

        return new ViewModel([
        ], 'core/admin-index/index');
    }
}