<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Group\Form\Admin\GroupLevel\AddGroupLevel;
use Neutron\Group\Form\Admin\GroupLevel\EditGroupLevel;
use Neutron\Group\Model\GroupLevel;

class AdminLevelController extends AdminController
{
    protected function afterInitialize()
    {

        _get('breadcrumb')
            ->set(['href' => _url('admin.group'), 'label' => _text('Groups', 'admin')]);

        _get('html.title')
            ->set(_text('Groups', 'admin'));

        _get('menu.admin.secondary')->load('admin', 'group');

        _get('menu.admin.buttons')->load('_group.buttons');
    }


    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => GroupLevel::class,
            'template' => 'group/admin/manage-level',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => GroupLevel::class,
            'form'     => AddGroupLevel::class,
            'redirect' => _url('admin.group.level'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => GroupLevel::class,
            'form'     => EditGroupLevel::class,
            'redirect' => _url('admin.group.level'),
        ]))->process();
    }
}