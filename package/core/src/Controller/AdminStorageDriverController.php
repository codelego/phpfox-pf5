<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\StorageDriver\AddStorageDriver;
use Neutron\Core\Form\Admin\StorageDriver\EditStorageDriver;
use Neutron\Core\Model\StorageDriver;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminStorageDriverController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->set(_text('Storage System', 'admin'));

        _service('breadcrumb')
            ->set([
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
            'model'    => StorageDriver::class,
            'template' => 'core/admin-storage/manage-storage-driver',
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'driver_id',
            'model'    => StorageDriver::class,
            'form'     => EditStorageDriver::class,
            'redirect' => _url('admin.core.storage.driver'),
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => StorageDriver::class,
            'form'     => AddStorageDriver::class,
            'redirect' => _url('admin.core.storage.driver'),
        ]))->process();
    }
}