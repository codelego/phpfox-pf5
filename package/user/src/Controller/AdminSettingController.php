<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditPermissionProcess;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingController extends AdminController
{
    protected function afterInitialize()
    {
        _get('menu.admin.secondary')->load('admin', 'user');

        _get('menu.admin.buttons')->load('_user.buttons');

        _get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin'),]);

    }

    public function actionIndex()
    {
        _get('breadcrumb')
            ->add(['href'  => _url('admin.user.setting', ['action' => 'index']),
                   'label' => _text('Settings', 'admin'),
            ]);

        return (new AdminEditSettingsProcess([
            'form_id' => 'user',
        ]))->process();
    }

    public function actionRegister()
    {
        _get('breadcrumb')
            ->add(['href'  => _url('admin.user.setting', ['action' => 'index']),
                   'label' => _text('Settings', 'admin'),
            ]);

        return (new AdminEditSettingsProcess([
            'form_id' => 'user_register',
        ]))->process();
    }
}