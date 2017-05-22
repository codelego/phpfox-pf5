<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditPermissionProcess;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingController extends AdminController
{
    protected function afterInitialize()
    {
        _get('menu.admin.secondary')->load('admin','user');

        _get('menu.admin.buttons')->load('_user.buttons');
    }

    public function actionIndex()
    {

    }

    public function actionAuth()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'user_login',
        ]))->process();
    }

    public function actionRegister()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'user_register',
        ]))->process();
    }

    public function actionPermission()
    {
        return (new AdminEditPermissionProcess([
            'levelType'  => 'user',
            'levelModel' => 'user_level',
        ]))->process();
    }
}