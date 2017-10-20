<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditPermissionProcess;

class AdminPermissionController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('menu.admin.secondary')->load('admin', 'user');

        \Phpfox::get('menu.admin.buttons')->load('_user.buttons');

        \Phpfox::get('html.title')->set(_text('Edit Permissions', '_core'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin'),])
            ->add([
                'href'  => _url('admin.user.setting', ['action' => 'permission']),
                'label' => _text('Permissions', 'admin'),
            ]);
    }

    public function actionIndex()
    {

        return (new AdminEditPermissionProcess([
            'itemType'   => 'user',
            'levelModel' => 'user_level',
        ]))->process();
    }
}