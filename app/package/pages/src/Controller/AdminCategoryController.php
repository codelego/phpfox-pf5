<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Pages\Form\Admin\PagesCategory\AddPagesCategory;
use Neutron\Pages\Form\Admin\PagesCategory\EditPagesCategory;
use Neutron\Pages\Model\PagesCategory;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Pages'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.pages'), 'label' => _text('Pages')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'pages');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => PagesCategory::class,
            'template' => 'pages/admin/manage-category',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => PagesCategory::class,
            'form'     => AddPagesCategory::class,
            'redirect' => _url('admin.pages.category'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'model'    => PagesCategory::class,
            'form'     => EditPagesCategory::class,
            'redirect' => _url('admin.pages.category'),
        ]))->process();
    }
}