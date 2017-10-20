<?php

namespace Neutron\Report\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;
use Neutron\Report\Model\ReportItem;

class AdminItemController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.report'),
                'label' => _text('Reports'),
            ]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'report');
        \Phpfox::get('menu.admin.buttons')->load('_report.buttons');

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => ReportItem::class,
            'template' => 'report/admin-item/manage-report',
        ]))->process();
    }
}