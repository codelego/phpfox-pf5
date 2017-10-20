<?php

namespace Neutron\Marketplace\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Marketplace'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.marketplace'), 'label' => _text('Marketplace')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'marketplace');

    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'marketplace',
        ]))->process();
    }
}