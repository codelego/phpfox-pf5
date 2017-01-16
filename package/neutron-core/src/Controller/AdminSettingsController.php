<?php
namespace Neutron\Core\Controller;

use Neutron\Core\Form\GeneralSettings;
use Phpfox\View\ViewModel;

class AdminSettingsController extends AdminController
{
    public function actionIndex()
    {
        $vm = new ViewModel([]);

        $form = new GeneralSettings();

        $vm->assign(['form' => $form, 'heading' => _text('General Settings')]);

        $vm->setTemplate('layout.admin.edit');

        return $vm;
    }
}