<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\AddNewRole;
use Neutron\Core\Form\AuthorizationSettings;
use Phpfox\View\ViewModel;

class AdminAuthorizationController extends AdminController
{
    public function actionIndex()
    {
        $items = \Phpfox::with('core_role')
            ->select()
            ->execute()
            ->all();

        $vm = new ViewModel();

        $temp = \Phpfox::with('user')
            ->select('role_id, count(*) as user_count')
            ->group('role_id')
            ->execute()
            ->setPrototype(null)
            ->all();
        $counter = [];

        foreach ($temp as $row) {
            $counter[$row['role_id']] = $row['user_count'];
        }

        $vm->assign([
            'items'   => $items,
            'counter' => $counter,
        ]);

        $vm->setTemplate('core/admin-authorization/index');

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

        $vm->setTemplate('layout/admin-edit');

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

        $vm->setTemplate('layout/admin-edit');

        return $vm;
    }

    public function actionEdit()
    {
        $form = new AddNewRole();

        $vm = new ViewModel();

        $vm->assign([
            'heading' => '',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout/admin-edit');

        return $vm;
    }

    public function actionSettings()
    {
        $vm = new ViewModel();
        $request = \Phpfox::get('mvc.request');

        $id = $request->get('id',1);
        $role = \Phpfox::get('core.roles')->findById($id);

        $form = new AuthorizationSettings();

        $vm->assign([
            'form'    => $form,
            'heading' => _text('#Edit "{0}" Permissions', null, null,
                [$role->getTitle()]),
        ]);

        $vm->setTemplate('layout/admin-edit');

        return $vm;

    }
}