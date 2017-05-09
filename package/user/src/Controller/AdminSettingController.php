<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSiteSettingsProcess;

class AdminSettingController extends AdminController
{
    public function actionIndex()
    {
        return (new AdminEditSiteSettingsProcess([
            'setting_group' => 'user_register',
        ]))->process();
    }
}