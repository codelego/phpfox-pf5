<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Group\Form\Admin\Group\FilterGroup;
use Neutron\Group\Model\Group;

class AdminGroupController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Groups'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.group'), 'label' => _text('Groups')]);

        _get('menu.admin.secondary')->load('admin', 'group');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'filter.form' => FilterGroup::class,
            'model'       => Group::class,
            'template'    => 'group/admin/manage-group',
        ]))->process();
    }
}