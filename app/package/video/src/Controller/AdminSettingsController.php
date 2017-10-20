<?php

namespace Neutron\Video\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
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
        return (new AdminEditSettingsProcess([
            'form_id' => 'video',
        ]))->process();

    }
}