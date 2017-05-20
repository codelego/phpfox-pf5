<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminI18nSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('International', 'admin'));

        _get('menu.admin.secondary')->load('_core.i18n');
    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'setting_group' => 'core_i18n',
        ]))->process();
    }
}