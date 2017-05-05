<?php

namespace Neutron\Core\Controller;

use Phpfox\View\ViewModel;

class AdminStorageController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()
            ->add(_text('Storage System', 'admin'));

        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage System', 'admin'),
            ]);

        _service('menu.admin.secondary')
            ->clear()
            ->add([
                'href'  => _url('admin.core.storage'),
                'label' => _text('Storage System', 'admin'),
            ])
            ->add([
                'href'  => _url('admin.core.storage', ['action' => 'add']),
                'label' => _text('Add Storage', 'admin'),
            ]);
    }

    public function actionIndex()
    {

        $items = $packages = _model('storage_adapter')
            ->select('*')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-storage/manage-storage');
    }

    public function actionAdd()
    {
        return new ViewModel([], 'core/admin-storage/manage-storage');
    }
}