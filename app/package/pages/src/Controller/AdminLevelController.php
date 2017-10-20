<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Pages\Form\Admin\PagesLevel\AddPagesLevel;
use Neutron\Pages\Form\Admin\PagesLevel\EditPagesLevel;
use Neutron\Pages\Form\Admin\PagesLevel\FilterPagesLevel;
use Neutron\Pages\Model\PagesLevel;

class AdminLevelController extends AdminController
{
    protected function afterInitialize()
    {

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.pages'), 'label' => _text('Pages', 'admin')]);

        \Phpfox::get('html.title')
            ->set(_text('Pages', 'admin'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'pages');

        \Phpfox::get('menu.admin.buttons')->load('_pages.buttons');
    }


    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'filter.form' => FilterPagesLevel::class,
            'model'       => PagesLevel::class,
            'template'    => 'pages/admin/manage-level',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => PagesLevel::class,
            'form'     => AddPagesLevel::class,
            'redirect' => _url('admin.pages.level'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => PagesLevel::class,
            'form'     => EditPagesLevel::class,
            'redirect' => _url('admin.pages.level'),
        ]))->process();
    }
}