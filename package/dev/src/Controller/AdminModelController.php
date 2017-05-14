<?php

namespace Neutron\Dev\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;
use Neutron\Dev\Form\Admin\DevTable\AddDevTable;
use Neutron\Dev\Form\Admin\DevTable\FilterDevTable;
use Neutron\Dev\Model\DevTable;

class AdminModelController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Rapid Development Tools', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('Rapid Development Tools', 'admin'));

        _get('menu.admin.secondary')
            ->load('admin.dev');

        _get('menu.admin.buttons')
            ->load('_dev.table.buttons');
    }

    public function actionIndex()
    {
        $select = _model('dev_model')
            ->select();

        $request = _get('request');
        $tableName = $request->get('table_name');
        $packageId = $request->get('package_id');

        if (!empty($packageId)) {
            $select->where('package_id like ?', '%' . $packageId . '%');
        }
        if (!empty($tableName)) {
            $select->where('table_name like ?', '%' . $tableName . '%');
        }

        return (new AdminManageEntryProcess([
            'filter'   => FilterDevTable::class,
            'select'   => $select,
            'noLimit'  => true,
            'template' => 'dev/admin-dev/manage-dev-model',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => DevTable::class,
            'form'     => AddDevTable::class,
            'redirect' => _url('admin.dev.table'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'table_name',
            'model'    => DevTable::class,
            'form'     => AddDevTable::class,
            'redirect' => _url('admin.dev.table', ['table_name' => $_GET['table_name']]),
        ]))->process();
    }

    public function actionDelete()
    {
        $request = _get('request');
        $identity = $request->get('table_name');

        $devTable = _model('dev_table')->findById($identity);

        if ($devTable instanceof DevTable) {
            $devTable->delete();
        }

        _redirect('admin.dev.table');
    }
}