<?php

namespace Neutron\Dev\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Dev\Form\Admin\DevTable\AddDevTable;
use Neutron\Dev\Form\Admin\DevTable\FilterDevTable;
use Neutron\Dev\Model\DevTable;

class AdminTableController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.mail'),
                'label' => _text('Rapid Development Tools', 'admin'),
            ]);

        \Phpfox::get('html.title')
            ->set(_text('Rapid Development Tools', 'admin'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'dev');

        \Phpfox::get('menu.admin.buttons')
            ->load('_dev.table.buttons');
    }

    public function actionIndex()
    {
        $select = \Phpfox::model('dev_table')
            ->select();

        $request = \Phpfox::get('request');
        $tableName = $request->get('table_name');
        $packageId = $request->get('package_id');

        if (!empty($packageId)) {
            $select->where('package_id like ?', '%' . $packageId . '%');
        }
        if (!empty($tableName)) {
            $select->where('table_name like ?', '%' . $tableName . '%');
        }

        return (new AdminListEntryProcess([
            'filter.form' => FilterDevTable::class,
            'select'      => $select,
            'noLimit'     => true,
            'template'    => 'dev/admin-dev/manage-dev-table',
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
        $request = \Phpfox::get('request');
        $identity = $request->get('table_name');

        $devTable = \Phpfox::model('dev_table')->findById($identity);

        if ($devTable instanceof DevTable) {
            $devTable->delete();
        }

        \Phpfox::redirect('admin.dev.table');
    }
}