<?php

namespace Neutron\ContactUs\Controller;


use Neutron\ContactUs\Form\EditContactDepartment;
use Neutron\ContactUs\Model\ContactDepartment;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminDepartmentController extends AdminController
{

    public function actionDepartments()
    {
        $items = \Phpfox::getModel('contact_department')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();

        $vm->assign(['items' => $items]);
        $vm->setTemplate('contact-us.admin-department.index');

        return $vm;
    }

    public function actionEdit()
    {
        $request = \Phpfox::get('mvc.request');
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
                $item = new ContactDepartment();
            }
            $item->fromArray($_POST);
            $item->save();

            \Phpfox::get('mvc.response')->redirect(_url('admin.contact-us'));
        }

        $vm = new ViewModel();

        $vm->assign([
            'heading' => _text('Edit "{0}"', 'admin', null,
                [$item->getTitle()]),
            'form'    => $form,
        ]);

        $vm->setTemplate('layout.admin-edit');

        return $vm;
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('mvc.request');

        $form = new EditContactDepartment();

        if ($request->isGet()) {

        } elseif ($request->isPost()) {
            $item = new ContactDepartment();
            $item->fromArray($_POST);
            $item->save();

            \Phpfox::get('mvc.response')->redirect(_url('admin.contact-us'));
        }

        $vm = new ViewModel();

        $vm->assign([
            'heading' => _text('Add Department', 'admin'),
            'form'    => $form,
        ]);

        $vm->setTemplate('layout.admin-edit');

        return $vm;
    }
}