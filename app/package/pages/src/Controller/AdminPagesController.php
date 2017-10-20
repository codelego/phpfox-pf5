<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Pages\Form\Admin\Pages\FilterPages;
use Neutron\Pages\Model\Pages;

class AdminPagesController extends AdminController
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
            'filter.form' => FilterPages::class,
            'model'       => Pages::class,
            'template'    => 'pages/admin/manage-pages',
        ]))->process();
    }
}