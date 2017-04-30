<?php

namespace Neutron\Report\Controller;

use Neutron\Core\Controller\AdminController;
use Neutron\Report\Form\AddCategory;
use Neutron\Report\Model\ReportCategory;
use Phpfox\View\ViewModel;

class AdminCategoryController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->add([
                'href'  => _url('admin.report'),
                'label' => _text('Reports'),
            ], true)->add([
                'href'  => _url('admin.report'),
                'label' => _text('Categories'),
            ]);

        \Phpfox::get('menu.admin.secondary')
            ->add([
                'href'  => _url('admin.report.add'),
                'label' => _text('Add Category'),
            ]);
    }

    public function actionIndex()
    {
        $items = \Phpfox::with('report_category')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'report/admin-category/index');

    }

    public function actionAdd()
    {
        \Phpfox::get('breadcrumb')
            ->add([
                'href'  => _url('admin.report.add'),
                'label' => _text('Add Category'),
            ]);

        $request = \Phpfox::get('request');
        $form = new AddCategory();

        if ($request->isGet()) {

        }

        if ($request->isPost()) {

            $form->populate($request->all());

            $data = $form->getData();
            $obj = new ReportCategory($data);
            $obj->save();

            \Phpfox::get('response')->redirect('');
        }

        return new ViewModel([
            'heading' => _text('Add New Category'),
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        \Phpfox::get('breadcrumb')
            ->add([
                'href'  => '#',
                'label' => _text('Edit'),
            ]);

        $id = \Phpfox::get('request')->get('id');
    }

    public function actionDelete()
    {

    }
}