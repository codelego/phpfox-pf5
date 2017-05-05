<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\UploadPackage;
use Phpfox\View\ViewModel;

class AdminPackageController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.package'),
                'label' => _text('Packages','admin'),
            ]);

        _service('html.title')
            ->clear()
            ->set(_text('Packages','admin'));
    }

    public function actionIndex()
    {
        $packages = _model('core_package')
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