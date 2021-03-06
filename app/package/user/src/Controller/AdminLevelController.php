<?php

namespace Neutron\User\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Model\AclLevel;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\User\Form\Admin\UserLevel\AddUserLevel;
use Neutron\User\Form\Admin\UserLevel\EditUserLevel;
use Neutron\User\Model\UserLevel;

class AdminLevelController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.user'), 'label' => _text('Members', 'admin'),])
            ->add(['href' => _url('admin.user.level'), 'label' => _text('Levels', 'admin'),]);

        \Phpfox::get('html.title')
            ->set(_text('Levels', '_core'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'user');

        \Phpfox::get('menu.admin.buttons')->load('_user.buttons');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            \Phpfox::get('menu.admin.buttons')->load('_core.acl.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => UserLevel::class,
            'template' => 'user/admin/manage-level',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => AclLevel::class,
            'form'     => AddUserLevel::class,
            'redirect' => _url('admin.core.acl'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => AclLevel::class,
            'form'     => EditUserLevel::class,
            'redirect' => _url('admin.core.acl'),
        ]))->process();
    }
}