<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\User\Form\Admin\User\AddUser;
use Neutron\User\Form\Admin\User\EditUser;
use Neutron\User\Form\AdminFilterUser;
use Neutron\User\Model\User;

class AdminUserController extends AdminController
{
    protected function afterInitialize()
    {

        _get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin')]);

        _get('html.title')
            ->set(_text('Members', 'admin'));

        _get('menu.admin.secondary')->load('admin', 'user');

        _get('menu.admin.buttons')->load('_user.buttons');
    }


    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'filter.form' => AdminFilterUser::class,
            'model'       => User::class,
            'template'    => 'user/admin-user/manage-user',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => User::class,
            'form'     => AddUser::class,
            'redirect' => _url('admin.user'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'user_id',
            'model'    => User::class,
            'form'     => EditUser::class,
            'redirect' => _url('admin.user'),
        ]))->process();
    }
}