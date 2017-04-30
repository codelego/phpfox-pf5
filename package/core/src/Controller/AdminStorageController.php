<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminStorageController extends AdminController
{
    public function actionIndex()
    {
        \Phpfox::get('breadcrumb')->add([
            'href'  => _url('admin.core.storage'),
            'label' => _text('Storage'),
        ]);

        \Phpfox::get('menu.admin.secondary')
            ->add([
                'label' => 'Add',
                'route' => 'admin.core.storage.add',
            ]);

        $items = $packages = \Phpfox::with('storage_adapter')
            ->select('*')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-storage/index');
    }

    public function actionAdd()
    {
        \Phpfox::get('breadcrumb')->add([
            'href'  => _url('admin.core.storage'),
            'label' => _text('Storage'),
        ])->add([
            'href'  => _url('admin.core.storage.add'),
            'label' => _text('Add Storage'),
        ]);

        \Phpfox::get('menu.admin.secondary')
            ->add([
                'label' => 'Add',
                'route' => 'admin.core.storage.add',
            ]);

        return new ViewModel([], 'core/admin-storage/index');
    }
}