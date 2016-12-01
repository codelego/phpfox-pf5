<?php

namespace Neutron\Core\Controller;

use Phpfox\Mvc\StandardController;
use Phpfox\View\ViewModel;

class AdminDashboardController extends StandardController
{
    public function actionIndex()
    {
        return new ViewModel('core.admin-dashboard.index');
    }
}