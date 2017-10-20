<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Video\Form\Admin\VideoCategory\AddVideoCategory;
use Neutron\Video\Form\Admin\VideoCategory\DeleteVideoCategory;
use Neutron\Video\Form\Admin\VideoCategory\EditVideoCategory;
use Neutron\Video\Model\VideoCategory;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Videos'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.video'), 'label' => _text('Videos')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'video');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'filter.form' => null,
                'model'       => VideoCategory::class,
                'template'    => 'video/admin/manage-category',
            ]
        ))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'form'     => AddVideoCategory::class,
            'model'    => VideoCategory::class,
            'redirect' => _url('admin.video.category'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'form'     => EditVideoCategory::class,
            'model'    => VideoCategory::class,
            'redirect' => _url('admin.video.category'),
        ]))->process();
    }

    public function actionDelete()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'form'     => DeleteVideoCategory::class,
            'model'    => VideoCategory::class,
            'redirect' => _url('admin.video.category'),
        ]))->process();
    }
}