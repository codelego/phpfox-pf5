<?php

namespace Neutron\Contact\Controller;


use Neutron\Contact\Form\EditContactDepartment;
use Neutron\Contact\Model\Department;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminDepartmentController extends AdminController
{

    protected function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->clear()
            ->add(['label' => 'Contact Us']);
    }

    public function actionDepartments()
    {
        $items = \Phpfox::with('contact_department')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'contact/admin-department/index');

    }

    public function actionEdit()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $item = \Phpfox::get('contact_us')
            ->findDepartmentById($id);

        $form = new EditContactDepartment();

        if ($request->isGet()) {
            if ($item) {
                $form->populate($item->toArray());
            }
        } elseif ($request->isPost()) {
            if (!$item) {
                $item = new Department();
            }
            $item->fromArray($_POST);
            $item->save();

            \Phpfox::get('response')->redirect(_url('admin.contact'));
        }

        return new ViewModel([
            'heading' => _text('Edit "{0}"', 'admin', null,
                [$item->getTitle()]),
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');

        $form = new EditContactDepartment();

        if ($request->isGet()) {

        } elseif ($request->isPost()) {
            $item = new Department();
            $item->fromArray($_POST);
            $item->save();

            \Phpfox::get('response')->redirect(_url('admin.contact'));
        }

        return new ViewModel([
            'heading' => _text('Add Department', 'admin'),
            'form'    => $form,
        ], 'layout/form-edit');

    }
}