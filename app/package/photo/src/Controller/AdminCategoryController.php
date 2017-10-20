<?php

namespace Neutron\Photo\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Photo\Form\Admin\PhotoCategory\AddPhotoCategory;
use Neutron\Photo\Form\Admin\PhotoCategory\DeletePhotoCategory;
use Neutron\Photo\Form\Admin\PhotoCategory\EditPhotoCategory;
use Neutron\Photo\Model\PhotoCategory;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')->set(_text('Photos'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.photo'), 'label' => _text('Photos')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'photo');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'filter.form' => null,
                'model'       => PhotoCategory::class,
                'template'    => 'photo/admin/manage-category',
            ]
        ))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'form'     => AddPhotoCategory::class,
            'model'    => PhotoCategory::class,
            'redirect' => _url('admin.photo.category'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'form'     => EditPhotoCategory::class,
            'model'    => PhotoCategory::class,
            'redirect' => _url('admin.photo.category'),
        ]))->process();
    }

    public function actionDelete()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'form'     => DeletePhotoCategory::class,
            'model'    => PhotoCategory::class,
            'redirect' => _url('admin.photo.category'),
        ]))->process();
    }
}