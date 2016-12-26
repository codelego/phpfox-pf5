<?php
namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminSettingsController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel('core.admin-settings.index', []);
    }
}