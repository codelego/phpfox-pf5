<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Group\Form\Admin\GroupCategory\AddGroupCategory;
use Neutron\Group\Form\Admin\GroupCategory\EditGroupCategory;
use Neutron\Group\Model\GroupCategory;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Groups'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.group'), 'label' => _text('Groups')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'group');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => GroupCategory::class,
            'template' => 'pages/admin/manage-category',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => GroupCategory::class,
            'form'     => AddGroupCategory::class,
            'redirect' => _url('admin.group.category'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'model'    => GroupCategory::class,
            'form'     => EditGroupCategory::class,
            'redirect' => _url('admin.group.category'),
        ]))->process();
    }
}