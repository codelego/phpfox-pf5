<?php

namespace Neutron\Event\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
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
        return (new AdminEditSettingsProcess([
            'form_id' => 'event',
        ]))->process();
    }
}