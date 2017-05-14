<?php

namespace Neutron\Contact\Controller;


use Neutron\Contact\Form\Admin\ContactDepartment\EditContactDepartment;
use Neutron\Contact\Model\Department;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminDepartmentController extends AdminController
{

    protected function initialized()
    {
        _get('breadcrumb')
            ->set(['label' => _text('Contact Us'), 'href' => _url('admin.contact.department')]);

        _get('html.title')
            ->set(_text('Contact Us'));

        _get('menu.admin.secondary')
            ->load('_contact_us');
    }

    public function actionIndex()
    {
        $items = _model('contact_department')
            ->select()
            ->execute()
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'contact/admin/manage-department');

    }

    public function actionEdit()
    {
        $request = _get('request');
        $departmentId = $request->get('department_id');

        $item = _get('contact_us')
            ->findDepartmentById($departmentId);

        $form = new EditContactDepartment([]);

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

            _redirect('admin.contact');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionAdd()
    {
        $request = _get('request');

        $form = new EditContactDepartment([]);

        if ($request->isGet()) {

        } elseif ($request->isPost()) {
            $item = new Department();
            $item->fromArray($_POST);
            $item->save();

            _redirect('admin.contact');
        }

        return new ViewModel([
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {

    }
}