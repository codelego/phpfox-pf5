<?php
namespace Neutron\Report\Controller;

use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminCategoryController extends AdminController
{
    public function actionIndex()
    {
        $items = \Phpfox::with('abuse_report_category')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();
        $vm->assign(['items' => $items]);

        $vm->setTemplate('abuse-report/admin-category/index');

        return $vm;
    }

    public function actionAdd()
    {

    }

    public function actionEdit()
    {

    }

    public function actionDelete()
    {

    }
}