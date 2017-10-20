<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\User\Form\Admin\User\AddUser;
use Neutron\User\Form\Admin\User\EditUser;
use Neutron\User\Form\AdminFilterUser;
use Neutron\User\Model\User;

class AdminUserController extends AdminController
{
    protected function afterInitialize()
    {

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin')]);

        \Phpfox::get('html.title')
            ->set(_text('Members', 'admin'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'user');

        \Phpfox::get('menu.admin.buttons')->load('_user.buttons');
    }


    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'filter.form' => AdminFilterUser::class,
            'model'       => User::class,
            'template'    => 'user/admin/manage-user',
        ]))->process();
    }
}