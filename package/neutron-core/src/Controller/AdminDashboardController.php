<?php

namespace Neutron\Core\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class AdminDashboardController extends MvcController
{
    public function actionIndex()
    {
        return new ViewModel('core.admin-dashboard.index');
    }
}