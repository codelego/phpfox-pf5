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
    protected function initialized()
    {

        _get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin')]);

        _get('html.title')
            ->set(_text('Members', 'admin'));
    }


    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'filter'   => AdminFilterUser::class,
            'model'    => User::class,
            'template' => 'user/admin-user/manage-user',
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