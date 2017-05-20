<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Manage Settings', 'admin'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.settings'),
                'label' => _text('Manage Settings', 'admin'),
            ]);
    }

    public function actionIndex()
    {

    }

    public function actionEdit()
    {
        return (new AdminEditSettingsProcess([]))->process();
    }
}