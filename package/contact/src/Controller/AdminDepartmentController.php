<?php

namespace Neutron\Contact\Controller;


use Neutron\Contact\Form\EditContactDepartment;
use Neutron\Contact\Model\Department;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminDepartmentController extends AdminController
{

    public function actionDepartments()
    {
        $items = \Phpfox::with('contact_department')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();

        $vm->assign(['items' => $items]);
        $vm->setTemplate('contact/admin-department/index');

        return $vm;
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

        $vm = new ViewModel();

        $vm->assign([
            'heading' => _text('Edit "{0}"', 'admin', null,
                [$item->getTitle()]),
            'form'    => $form,
        ]);

        $vm->setTemplate('layout/form-edit');

        return $vm;
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

        $vm = new ViewModel();

        $vm->assign([
            'heading' => _text('Add Department', 'admin'),
            'form'    => $form,
        ]);

        $vm->setTemplate('layout/form-edit');

        return $vm;
    }
}