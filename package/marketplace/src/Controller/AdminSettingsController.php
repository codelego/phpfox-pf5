<?php

namespace Neutron\Marketplace\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Marketplace'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.marketplace'), 'label' => _text('Marketplace')]);

        _get('menu.admin.secondary')->load('admin', 'marketplace');

    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'marketplace',
        ]))->process();
    }
}