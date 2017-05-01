<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\AddNewRole;
use Neutron\Core\Form\AuthorizationSettings;
use Phpfox\View\ViewModel;

class AdminAuthorizationController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('menu.admin.secondary')
            ->add([
                'name'  => 'add_role',
                'label' => _text('Add Role'),
                'route' => 'admin.core.authorization.add',
            ]);
    }

    public function actionIndex()
    {

        $items = \Phpfox::with('core_role')
            ->select()
            ->execute()
            ->all();

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

        return new ViewModel([
            'items'   => $items,
            'counter' => $counter,
        ], 'core/admin-authorization/index');
    }

    public function actionAdd()
    {
        $form = new AddNewRole();

        return new ViewModel([
            'heading' => '',
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionDelete()
    {
        $form = new AddNewRole();

        return new ViewModel([
            'heading' => '',
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $form = new AddNewRole();

        return new ViewModel([
            'heading' => '',
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionSettings()
    {
        $request = \Phpfox::get('request');

        $id = $request->get('id', 1);
        $role = \Phpfox::get('core.roles')->findById($id);

        $form = new AuthorizationSettings();

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('#Edit "{0}" Permissions', null, null,
                [$role->getTitle()]),
        ], 'layout/form-edit');

    }
}