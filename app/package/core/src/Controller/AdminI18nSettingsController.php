<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminI18nSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.i18n'),
                'label' => _text('International', 'admin'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('International', 'admin'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'i18n');
    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'core_i18n',
        ]))->process();
    }
}