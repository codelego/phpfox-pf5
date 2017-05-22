<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\CorePackage\FilterCorePackage;
use Neutron\Core\Form\Admin\CorePackage\UploadPackage;
use Neutron\Core\Model\CorePackage;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminPackageController extends AdminController
{
    protected function afterInitialize()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.package'),
                'label' => _text('Packages', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('Packages', 'admin'));

        _get('menu.admin.secondary')->load('admin','package');

        _get('menu.admin.buttons')
            ->load('_core.package.buttons');
    }

    public function actionIndex()
    {
        $message = _text('summary_packages_message', '_core.package', [
            _model('core_package')->select()->count(),
            _model('core_package')->select()->where('is_active=1')->count(),
        ]);

        return (new AdminListEntryProcess([
            'filter'   => FilterCorePackage::class,
            'model'    => CorePackage::class,
            'noLimit'  => true,
            'limit'    => 4,
            'data'     => ['message' => $message],
            'template' => 'core/admin-package/manage-core-package',
        ]))->process();
    }

    public function actionEnable()
    {
        $request = _get('request');

        /** @var CorePackage $corePackage */
        $corePackage = _find('core_package', $request->get('package_id'));

        if (!$corePackage) {
            throw new \InvalidArgumentException('Missing params "package_id"');
        }

        $corePackage->setActive(1);
        $corePackage->save();

        _get('shared.cache')->flush();

        _redirect('admin.core.package');
    }

    public function actionDisable()
    {
        $request = _get('request');

        /** @var CorePackage $corePackage */
        $corePackage = _find('core_package', $request->get('package_id'));

        if (!$corePackage) {
            throw new \InvalidArgumentException('Missing params "package_id"');
        }

        $corePackage->setActive(0);
        $corePackage->save();

        _redirect('admin.core.package');
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