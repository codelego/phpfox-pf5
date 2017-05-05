<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminStorageController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage'),
            ])->add([
                'href'  => _url('admin.core.storage.add'),
                'label' => _text('Add Storage'),
            ]);

        _service('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => 'Add',
                'route' => 'admin.core.storage.add',
            ]);
    }

    public function actionIndex()
    {

        $items = $packages = _with('storage_adapter')
            ->select('*')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-storage/index');
    }

    public function actionAdd()
    {
        return new ViewModel([], 'core/admin-storage/index');
    }
}