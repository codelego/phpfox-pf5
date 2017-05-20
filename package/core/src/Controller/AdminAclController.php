<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\AclRole\AddAclRole;
use Neutron\Core\Form\Admin\AclRole\EditAclRole;
use Neutron\Core\Model\AclLevel;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminEditPermissionProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminAclController extends AdminController
{
    protected function initialized()
    {
        _get('breadcrumb')
            ->set(['href' => _url('admin.core.acl'), 'label' => _text('User Groups', 'admin'),]);

        _get('html.title')
            ->set(_text('Permission Settings', '_core'));

        _get('menu.admin.secondary')
            ->load('_core.acl');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('_core.acl.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => AclLevel::class,
            'template' => 'core/admin-acl/manage-acl-role',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => AclLevel::class,
            'form'     => AddAclRole::class,
            'redirect' => _url('admin.core.acl'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => AclLevel::class,
            'form'     => EditAclRole::class,
            'redirect' => _url('admin.core.acl'),
        ]))->process();
    }

    public function actionSettings()
    {
        $request = _get('request');

        return (new AdminEditPermissionProcess(['form_id' => 'core_general']))->process();

    }
}