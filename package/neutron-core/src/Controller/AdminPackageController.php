<?php
namespace Neutron\Core\Controller;

use Neutron\Core\Form\UploadPackage;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AdminPackageController extends ActionController
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
        $vm->setTemplate('core.admin-package.index');

        return $vm;
    }

    public function actionApps()
    {
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->where('is_app=1')
            ->order('is_core', -1)
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $packages,
        ]);
        $vm->setTemplate('core.admin-package.index');

        return $vm;
    }

    public function actionThemes()
    {
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->where('is_theme=1')
            ->order('is_core', -1)
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $packages,
        ]);
        $vm->setTemplate('core.admin-package.index');

        return $vm;
    }

    public function actionLibraries()
    {
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->where('is_library=1')
            ->order('is_core', -1)
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $packages,
        ]);
        $vm->setTemplate('core.admin-package.index');

        return $vm;
    }

    public function actionLanguages()
    {
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->where('is_language=1')
            ->order('is_core', -1)
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $packages,
        ]);
        $vm->setTemplate('core.admin-package.index');

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

        $vm->setTemplate('layout.admin.edit');

        return $vm;
    }
}