<?php

namespace Neutron\Report\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;
use Neutron\Report\Form\Admin\ReportItem\AddReportItem;
use Neutron\Report\Form\Admin\ReportItem\EditReportItem;
use Neutron\Report\Model\ReportItem;

class AdminItemController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.report'),
                'label' => _text('Reports'),
            ]);

        _get('menu.admin.secondary')->load('_report');

    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'model'    => ReportItem::class,
            'template' => 'report/admin-item/manage-report-item',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => ReportItem::class,
            'form'     => AddReportItem::class,
            'redirect' => _url('admin.report.category'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'item_id',
            'model'    => ReportItem::class,
            'form'     => EditReportItem::class,
            'redirect' => _url('admin.report.category'),
        ]))->process();
    }
}