<?php

namespace Neutron\Group\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Groups'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.group'), 'label' => _text('Groups')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'group');

    }

    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'group',
        ]))->process();
    }
}