<?php

namespace Neutron\Announcement\Controller;


use Neutron\Announcement\Form\AddAnnouncement;
use Neutron\Announcement\Model\Announcement;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminManageController extends AdminController
{
    public function actionAdd()
    {
        $form = new AddAnnouncement();

        $request = \Phpfox::get('mvc.request');

        if ($request->isGet()) {

        }

        if ($request->isPost()) {
            $form->populate($request->getParams());
            $data = $form->getData();
            $obj = new Announcement($data);
            $obj->save();
        }


        $vm = new ViewModel([
            'form'    => $form,
            'heading' => _text('Add Announcement'),
        ], 'layout/admin-edit');

        return $vm;
    }
}