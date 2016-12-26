<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminDashboardController extends ActionController
{
    /**
     * @return ViewModel
     */
    public function actionIndex()
    {
        return new ViewModel('core.admin-dashboard.index');
    }
}