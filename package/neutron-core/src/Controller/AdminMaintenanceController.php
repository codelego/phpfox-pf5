<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\MaintenanceSettings;
use Phpfox\View\ViewModel;

class AdminMaintenanceController extends AdminController
{
    public function actionIndex()
    {
        $vm = new ViewModel();

        $form = new MaintenanceSettings([]);

        $vm->assign(['form'    => $form,
                     'heading' => _text('Maintenance Settings'),
        ]);

        $vm->setTemplate('layout.admin.edit');

        return $vm;
    }
}