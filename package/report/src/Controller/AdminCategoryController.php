<?php
namespace Neutron\Report\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Report\Form\AddCategory;
use Neutron\Report\Model\ReportCategory;
use Phpfox\View\ViewModel;

class AdminCategoryController extends AdminController
{
    public function actionIndex()
    {
        $items = \Phpfox::with('report_category')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();
        $vm->assign(['items' => $items]);
        $vm->setTemplate('report/admin-category/index');

        return $vm;
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');


        $form = new AddCategory();

        $vm = new ViewModel([
            'heading' => 'add new category',
            'form'    => $form,
        ], 'layout/form-edit');

        if ($request->isGet()) {

        }

        if ($request->isPost()) {
            $form->populate($request->all());

            $data = $form->getData();

            $obj = new ReportCategory($data);

            $obj->save();

            \Phpfox::get('response')->redirect('');
        }
        return $vm;

    }

    public function actionEdit()
    {

    }

    public function actionDelete()
    {

    }
}