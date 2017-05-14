<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Process\AdminManageSiteSettingsProcess;

class AdminI18nSettingsController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('International', 'admin'));

        _get('menu.admin.secondary')->load('admin.core.i18n');
    }

    public function actionIndex()
    {
        return (new AdminManageSiteSettingsProcess([
            'setting_group' => 'core_i18n',
        ]))->process();
    }
}