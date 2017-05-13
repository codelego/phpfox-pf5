<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\UploadPackage;
use Neutron\Core\Model\CorePackage;
use Neutron\Core\Process\AdminManageEntryProcess;
use Phpfox\View\ViewModel;

class AdminPackageController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->set([
                'href'  => _url('admin.core.package'),
                'label' => _text('Packages', 'admin'),
            ]);

        _service('html.title')
            ->set(_text('Packages', 'admin'));
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'model'    => CorePackage::class,
            'noLimit'  => true,
            'limit'    => 4,
            'template' => 'core/admin-package/manage-core-package',
        ]))->process();
    }

    public function actionAdd()
    {
        $form = new UploadPackage();

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}