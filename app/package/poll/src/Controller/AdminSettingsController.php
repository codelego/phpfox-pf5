<?php

namespace Neutron\Poll\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
{

    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Polls'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.poll'), 'label' => _text('Polls')]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'poll');
    }


    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'poll',
        ]))->process();
    }
}