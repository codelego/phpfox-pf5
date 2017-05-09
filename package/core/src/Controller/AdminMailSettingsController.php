<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Process\AdminEditSiteSettingsProcess;

class AdminMailSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Mail Settings', 'menu'),
            ]);

        _service('html.title')
            ->set(_text('Mail Settings', 'menu'));

        _service('menu.admin.secondary')
            ->load('admin.core.mail');
    }

    public function actionIndex()
    {
        return (new AdminEditSiteSettingsProcess([
            'setting_group' => 'core_mail',
        ]))->process();
    }
}