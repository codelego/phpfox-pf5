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
        _get('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.report'),
                'label' => _text('Reports'),
            ])->add([
                'href'  => _url('admin.report'),
                'label' => _text('Categories'),
            ]);

        _get('menu.admin.secondary')
            ->clear()
            ->add([
                'href'  => _url('admin.report.add'),
                'label' => _text('Add Category'),
            ]);
    }

    public function actionIndex()
    {
        $items = _with('report_category')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'report/admin-category/index');

    }

    public function actionAdd()
    {

        $request = _get('request');
        $form = new AddCategory();

        if ($request->isGet()) {

        }

        if ($request->isPost()) {

            $form->populate($request->all());

            $data = $form->getData();
            $obj = new ReportCategory($data);
            $obj->save();

            _get('response')->redirect('');
        }

        return new ViewModel([
            'heading' => _text('Add New Category'),
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
    }

    public function actionDelete()
    {

    }
}