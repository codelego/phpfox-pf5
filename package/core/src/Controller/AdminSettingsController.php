<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\GeneralSettings;
use Phpfox\View\ViewModel;

class AdminSettingsController extends AdminController
{
    public function actionIndex()
    {
        $form = new GeneralSettings();

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('General Settings'),
        ], 'layout/form-edit');
    }
}