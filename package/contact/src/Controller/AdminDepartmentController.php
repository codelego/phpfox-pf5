<?php

namespace Neutron\Contact\Controller;


use Neutron\Contact\Form\Admin\ContactDepartment\DeleteContactDepartment;
use Neutron\Contact\Form\Admin\ContactDepartment\EditContactDepartment;
use Neutron\Contact\Model\ContactDepartment;
use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminDepartmentController extends AdminController
{

    protected function afterInitialize()
    {
        _get('breadcrumb')
            ->set(['label' => _text('Contact Us'), 'href' => _url('admin.contact.department')]);

        _get('html.title')
            ->set(_text('Contact Us'));

        _get('menu.admin.secondary')->load('admin', 'contact');

        _get('menu.admin.buttons')
            ->load('_contact.buttons');
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'noLimit'  => true,
            'model'    => ContactDepartment::class,
            'template' => 'contact/admin/manage-contact-department',
        ]))->process();
    }

    public function actionEdit()
    {
        $request = _get('request');
        $departmentId = $request->get('department_id');

        /** @var ContactDepartment $entry */
        $entry = _model('contact_department')
            ->findById($departmentId);

        $form = new EditContactDepartment(['department_id' => $departmentId]);

        if ($request->isGet()) {
            if ($entry) {
                $form->populate($entry->toArray());
            }
        }


        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->fromArray($form->getData());
            $entry->save();
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

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $item = _model('contact_department')->create($form->getData());
            $item->save();
            _redirect('admin.contact');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $request = _get('request');

        /** @var ContactDepartment $entry */
        $entry = _model('contact_department')
            ->findById($request->get('department_id'));

        $form = new DeleteContactDepartment([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->delete();
            _redirect('admin.contact');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}