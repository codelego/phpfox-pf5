<?php

namespace Neutron\Contact\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditSettingsProcess;

class AdminSettingsController extends AdminController
{
    public function actionIndex()
    {
        return (new AdminEditSettingsProcess([
            'form_id' => 'contact',
        ]))->process();
    }
}