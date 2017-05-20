<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\Admin\AclRole\AddAclRole;
use Neutron\Core\Form\Admin\AclRole\EditAclRole;
use Neutron\Core\Form\Admin\AclSettingGroup\FilterAclPermissions;
use Neutron\Core\Form\Admin\Settings\EditCoreAclSettings;
use Neutron\Core\Model\AclLevel;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminBanController extends AdminController
{
    protected function afterInitialize()
    {
        _get('breadcrumb')
            ->set(['href' => _url('admin.core.ban'), 'label' => _text('User Groups', 'admin'),]);

        _get('html.title')
            ->set(_text('Ban Settings', 'admin'));

        _get('menu.admin.secondary')
            ->load('_core.ban');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('_core.ban.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => AclLevel::class,
            'template' => 'core/admin-ban/manage-ban-role',
        ]))->process();
    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => AclLevel::class,
            'form'     => AddAclRole::class,
            'redirect' => _url('admin.core.ban'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'level_id',
            'model'    => AclLevel::class,
            'form'     => EditAclRole::class,
            'redirect' => _url('admin.core.ban'),
        ]))->process();
    }

    public function actionSettings()
    {
        $request = _get('request');

        $filter = new FilterAclPermissions();

        _get('registry')
            ->set('filter', $filter);

        $id = $request->get('id', 1);
        $role = _get('core.roles')->findById($id);

        $form = new EditCoreAclSettings();

        $form->setTitle(_text('#Edit "{0}" Permissions', null, null, [$role->getTitle()]));
        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');

    }
}