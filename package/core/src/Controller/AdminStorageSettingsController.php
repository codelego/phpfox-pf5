<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Process\AdminManageSiteSettingsProcess;

class AdminStorageSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Storage System', 'admin'));

        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage System', 'admin'),
            ]);

        _service('menu.admin.secondary')
            ->load('admin.core.storage');
    }

    public function actionIndex()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'core_storage',
        ]))->process();
    }

}