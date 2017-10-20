<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\AclRole\AddAclRole;
use Neutron\Core\Form\Admin\AclRole\EditAclRole;
use Neutron\Core\Model\AclLevel;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminBanController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.core.ban'), 'label' => _text('User Groups', 'admin'),]);

        \Phpfox::get('html.title')
            ->set(_text('Ban Settings', 'admin'));

        \Phpfox::get('menu.admin.secondary')
            ->load('_core.ban');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            \Phpfox::get('menu.admin.buttons')->load('_core.ban.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => AclLevel::class,
            'template' => 'core/admin-ban/manage-ban-role',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => AclLevel::class,
            'form'     => AddAclRole::class,
            'redirect' => _url('admin.core.ban'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => AclLevel::class,
            'form'     => EditAclRole::class,
            'redirect' => _url('admin.core.ban'),
        ]))->process();
    }

    public function actionSettings()
    {

    }
}