<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Event\Form\Admin\EventLevel\AddEventLevel;
use Neutron\Event\Form\Admin\EventLevel\EditEventLevel;
use Neutron\Event\Model\EventLevel;

class AdminLevelController extends AdminController
{
    protected function afterInitialize()
    {

        _get('html.title')
            ->set(_text('Events'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.event'), 'label' => _text('Events')]);

        _get('menu.admin.secondary')->load('admin','event');

        _get('menu.admin.buttons')->load('_event.buttons');
    }


    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => EventLevel::class,
            'template' => 'event/admin/manage-level',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => EventLevel::class,
            'form'     => AddEventLevel::class,
            'redirect' => _url('admin.event.level'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => EventLevel::class,
            'form'     => EditEventLevel::class,
            'redirect' => _url('admin.event.level'),
        ]))->process();
    }
}