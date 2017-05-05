<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\GeneralSettings;
use Phpfox\View\ViewModel;

class AdminSettingsController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()
            ->add(_text('Manage Settings', 'admin'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.core.settings'), 'label' => _text('Manage Settings', 'admin')]);
    }

    public function actionIndex()
    {
        $form = new GeneralSettings();

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('General Settings'),
        ], 'layout/form-edit');
    }
}