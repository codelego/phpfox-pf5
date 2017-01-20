<?php
namespace Neutron\Core\Controller;

use Neutron\Core\Form\UploadPackage;
use Phpfox\View\ViewModel;

class AdminPackageController extends AdminController
{
    public function actionIndex()
    {
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $packages,
        ]);
        $vm->setTemplate('core/admin-package/index');

        return $vm;
    }

    public function actionAdd()
    {
        $vm = new ViewModel();

        $form = new UploadPackage();

        $vm->assign([
            'heading' => 'Upload Package',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout/admin-edit');

        return $vm;
    }
}