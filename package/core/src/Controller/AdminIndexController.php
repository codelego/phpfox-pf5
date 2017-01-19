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
        $vm = new ViewModel();

        $vm->setTemplate('core.admin-dashboard.index');

        return $vm;
    }
}