<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminStorageController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage'),
            ])->add([
                'href'  => _url('admin.core.storage.add'),
                'label' => _text('Add Storage'),
            ]);

        \Phpfox::get('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => 'Add',
                'route' => 'admin.core.storage.add',
            ]);
    }

    public function actionIndex()
    {

        $items = $packages = \Phpfox::with('storage_adapter')
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