<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminSiteSettingsProcess;

class AdminSettingController extends AdminController
{
    public function actionIndex()
    {
        return (new AdminSiteSettingsProcess([
            'setting_group' => 'user_register',
        ]))->process();
    }
}