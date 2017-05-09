<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Model\StorageAdapter;
use Neutron\Core\Process\AdminManageEntryProcess;
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
            ->load('admin.core.storage');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')
                ->load('admin.core.storage.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'noLimit'  => true,
            'model'    => StorageAdapter::class,
            'template' => 'core/admin-storage/manage-storage-adapter',
        ]))->process();
    }

    public function actionAdd()
    {
        return new ViewModel([], 'core/admin-storage/manage-storage-adapter');
    }
}