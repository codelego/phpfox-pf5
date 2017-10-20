<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('menu.admin.secondary')->load('admin', 'user');

        \Phpfox::get('menu.admin.buttons')->load('_user.buttons');

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin'),]);

        \Phpfox::get('html.title')
            ->set(_text('Edit User Settings', '_user'));
    }

    public function actionIndex()
    {
        \Phpfox::get('breadcrumb')
            ->add([
                'href'  => _url('admin.user.setting', ['action' => 'index']),
                'label' => _text('Settings', 'admin'),
            ]);

        return (new AdminEditSettingsProcess([
            'form_id' => 'user',
        ]))->process();
    }

    public function actionRegister()
    {
        \Phpfox::get('breadcrumb')
            ->add([
                'href'  => _url('admin.user.setting', ['action' => 'index']),
                'label' => _text('Settings', 'admin'),
            ]);

        return (new AdminEditSettingsProcess([
            'form_id' => 'user_register',
        ]))->process();
    }
}