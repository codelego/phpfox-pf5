<?php

namespace Neutron\Core\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class AdminDashboardController extends MvcController
{
    /**
     * @return ViewModel
     */
    public function actionIndex()
    {
        return new ViewModel('core');
    }
}