<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Event\Form\Admin\Event\FilterEvent;
use Neutron\Event\Model\Event;

class AdminEventController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Events'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.event'), 'label' => _text('Events')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'event');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'filter.form' => FilterEvent::class,
            'model'       => Event::class,
            'template'    => 'event/admin/manage-event',
        ]))->process();
    }

    public function actionEdit()
    {

    }

    public function actionAdd()
    {
    }
}