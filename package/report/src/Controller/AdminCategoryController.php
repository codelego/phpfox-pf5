<?php

namespace Neutron\Report\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Report\Form\AddCategory;
use Neutron\Report\Form\Admin\ReportCategory\AddReportCategory;
use Neutron\Report\Form\Admin\ReportCategory\EditReportCategory;
use Neutron\Report\Model\ReportCategory;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.report'),
                'label' => _text('Reports'),
            ])->add([
                'href'  => _url('admin.report'),
                'label' => _text('Categories'),
            ]);

        _get('menu.admin.secondary')->load('_report');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => ReportCategory::class,
            'template' => 'report/admin-category/manage-report-category',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => ReportCategory::class,
            'form'     => AddReportCategory::class,
            'redirect' => _url('admin.report.category'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'category_id',
            'model'    => ReportCategory::class,
            'form'     => EditReportCategory::class,
            'redirect' => _url('admin.report.category'),
        ]))->process();
    }
}