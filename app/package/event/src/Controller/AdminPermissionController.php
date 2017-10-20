<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditPermissionProcess;

class AdminPermissionController extends AdminController
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
        return (new AdminEditPermissionProcess([
            'itemType'   => 'event',
            'levelModel' => 'event_level',
        ]))->process();
    }
}