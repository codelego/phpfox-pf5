<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminIndexController extends AdminController
{
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