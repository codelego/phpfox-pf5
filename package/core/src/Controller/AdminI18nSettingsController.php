<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Process\AdminManageSiteSettingsProcess;

class AdminI18nSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _service('html.title')
            ->set(_text('International', 'admin'));

        _service('menu.admin.secondary')->load('admin.core.i18n');
    }

    public function actionIndex()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'core_i18n',
        ]))->process();
    }
}