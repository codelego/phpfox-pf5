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

        $request = _service('request');

        if ($request->isGet()) {

        }

        if ($request->isPost()) {
            $form->populate($request->all());
            $data = $form->getData();
            $obj = new Announcement($data);
            $obj->setDescription('');
            $obj->setUserId(1);
            $obj->save();
        }


        $vm = new ViewModel([
            'form'    => $form,
        ], 'layout/form-edit');

        return $vm;
    }
}