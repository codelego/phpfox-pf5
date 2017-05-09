<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\AclRole\AddAclRole;
use Neutron\Core\Form\Admin\AclRole\EditAclRole;
use Neutron\Core\Form\AuthorizationSettings;
use Neutron\Core\Model\AclRole;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;
use Phpfox\View\ViewModel;

class AdminAclRoleController extends AdminController
{
    protected function initialized()
    {
        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.acl'),
                'label' => _text('Authorizations', 'admin'),
            ]);

        _service('html.title')
            ->clear()
            ->set(_text('Authorizations', 'admin'));

        _service('menu.admin.secondary')->load('admin.core.acl');
    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')->load('admin.core.acl.role.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
            'model'    => AclRole::class,
            'template' => 'core/admin-acl/manage-acl-role',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => AclRole::class,
            'form'     => AddAclRole::class,
            'redirect' => _url('admin.core.acl.role'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'role_id',
            'model'    => AclRole::class,
            'form'     => EditAclRole::class,
            'redirect' => _url('admin.core.acl.role'),
        ]))->process();
    }

    public function actionSettings()
    {
        $request = _service('request');

        $id = $request->get('id', 1);
        $role = _service('core.roles')->findById($id);

        $form = new AuthorizationSettings();

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('#Edit "{0}" Permissions', null, null,
                [$role->getTitle()]),
        ], 'layout/form-edit');

    }
}