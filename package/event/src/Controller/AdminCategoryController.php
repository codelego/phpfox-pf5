<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Event\Form\Admin\EventCategory\AddEventCategory;
use Neutron\Event\Form\Admin\EventCategory\EditEventCategory;
use Neutron\Event\Model\EventCategory;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Events'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.event'), 'label' => _text('Events')]);

        _get('menu.admin.secondary')->load('admin', 'event');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => EventCategory::class,
            'template' => 'event/admin/manage-category',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => EventCategory::class,
            'form'     => AddEventCategory::class,
            'redirect' => _url('admin.event.category'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'model'    => EventCategory::class,
            'form'     => EditEventCategory::class,
            'redirect' => _url('admin.event.category'),
        ]))->process();
    }
}