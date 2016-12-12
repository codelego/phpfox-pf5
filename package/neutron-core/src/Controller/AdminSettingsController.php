<?php
namespace Neutron\Core\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class AdminSettingsController extends MvcController
{
    public function actionIndex()
    {
        return new ViewModel('core.admin-settings.index', []);
    }
}