<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\CorePackage\FilterCorePackage;
use Neutron\Core\Form\Admin\CorePackage\UploadPackage;
use Neutron\Core\Model\CorePackage;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Core\Service\FilterCorePackageService;
use Phpfox\View\ViewModel;

class AdminPackageController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.package'),
                'label' => _text('Packages', 'admin'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('Packages', 'admin'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'package');

        \Phpfox::get('menu.admin.buttons')
            ->load('_core.package.buttons');
    }

    public function actionIndex()
    {
        $message = _text('summary_packages_message', '_core.package', [
            \Phpfox::model('core_package')->select()->count(),
            \Phpfox::model('core_package')->select()->where('is_active=1')->count(),
        ]);

        return (new AdminListEntryProcess([
            'filter.form'    => FilterCorePackage::class,
            'filter.service' => new FilterCorePackageService(),
            'model'          => CorePackage::class,
            'noLimit'        => true,
            'limit'          => 4,
            'data'           => ['message' => $message],
            'template'       => 'core/admin-package/manage-core-package',
        ]))->process();
    }

    public function actionEnable()
    {
        $request = \Phpfox::get('request');

        /** @var CorePackage $corePackage */
        $corePackage = \Phpfox::find('core_package', $request->get('package_id'));

        if (!$corePackage) {
            throw new \InvalidArgumentException('Missing params "package_id"');
        }

        $corePackage->setActive(1);
        $corePackage->save();

        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.package');
    }

    public function actionDisable()
    {
        $request = \Phpfox::get('request');

        /** @var CorePackage $corePackage */
        $corePackage = \Phpfox::find('core_package', $request->get('package_id'));

        if (!$corePackage) {
            throw new \InvalidArgumentException('Missing params "package_id"');
        }

        $corePackage->setActive(0);
        $corePackage->save();

        \Phpfox::redirect('admin.core.package');
    }

    /**
     *
     */
    public function actionExport()
    {
        return new ViewModel([

        ], 'core/admin-index/coming-soon');
    }

    public function actionDelete()
    {
        return new ViewModel([

        ], 'core/admin-index/coming-soon');
    }

    public function actionUpload()
    {
        $form = new UploadPackage();

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}