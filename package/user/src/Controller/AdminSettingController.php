<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminManageSiteSettingsProcess;

class AdminSettingController extends AdminController
{
    public function actionIndex()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'user_register',
        ]))->process();
    }
}