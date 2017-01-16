<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\AddNewRole;
use Phpfox\View\ViewModel;

class AdminAuthorizationController extends AdminController
{
    public function actionIndex()
    {
        $items = \Phpfox::getModel('authorization_role')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();

        $vm->assign([
            'items' => $items,
        ]);

        $vm->setTemplate('core.admin-authorization.index');

        return $vm;
    }

    public function actionAdd()
    {
        $form = new AddNewRole();

        $vm = new ViewModel();

        $vm->assign([
            'heading' => '',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout.admin.edit');

        return $vm;
    }

    public function actionDelete()
    {
        $form = new AddNewRole();

        $vm = new ViewModel();

        $vm->assign([
            'heading' => '',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout.admin.edit');

        return $vm;
    }

    public function actionEdit()
    {

    }

    public function actionSettings()
    {

    }
}