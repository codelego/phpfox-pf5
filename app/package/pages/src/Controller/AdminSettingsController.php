<?php

namespace Neutron\Pages\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
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
        return (new AdminEditSettingsProcess([
            'form_id' => 'pages',
        ]))->process();
    }
}