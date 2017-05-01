<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\UploadPackage;
use Phpfox\View\ViewModel;

class AdminPackageController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.package'),
                'label' => _text('Package'),
            ]);
    }

    public function actionIndex()
    {
        $packages = \Phpfox::with('core_package')
            ->select()
            ->order('is_required', -1)
            ->order('title', 1)
            ->all();

        return new ViewModel([
            'items' => $packages,
        ], 'core/admin-package/index');
    }

    public function actionAdd()
    {
        $form = new UploadPackage();

        return new ViewModel([
            'heading' => 'Upload Package',
            'form'    => $form,
        ], 'layout/form-edit');
    }
}