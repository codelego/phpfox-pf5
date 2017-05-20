<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingController extends AdminController
{
    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'setting_group' => 'user_register',
        ]))->process();
    }
}