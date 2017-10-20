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
        \Phpfox::get('breadcrumb')
            ->set(['label' => _text('Contact Us'), 'href' => _url('admin.contact.department')]);

        \Phpfox::get('html.title')
            ->set(_text('Contact Us'));

        \Phpfox::get('menu.admin.secondary')->load('admin', 'contact');

        \Phpfox::get('menu.admin.buttons')
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
        $request = \Phpfox::get('request');
        $departmentId = $request->get('department_id');

        /** @var ContactDepartment $entry */
        $entry = \Phpfox::model('contact_department')
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
            \Phpfox::redirect('admin.contact');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');

        $form = new EditContactDepartment([]);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $item = \Phpfox::model('contact_department')->create($form->getData());
            $item->save();
            \Phpfox::redirect('admin.contact');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $request = \Phpfox::get('request');

        /** @var ContactDepartment $entry */
        $entry = \Phpfox::model('contact_department')
            ->findById($request->get('department_id'));

        $form = new DeleteContactDepartment([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->delete();
            \Phpfox::redirect('admin.contact');
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}