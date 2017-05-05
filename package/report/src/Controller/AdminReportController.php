<?php

namespace Neutron\Report\Controller;


use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminReportController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.report'),
                'label' => _text('Reports'),
            ]);

        _service('menu.admin.secondary')->load('admin.report');

    }

    public function actionIndex()
    {

        return new ViewModel([], 'report/admin/manage-report');
    }
}