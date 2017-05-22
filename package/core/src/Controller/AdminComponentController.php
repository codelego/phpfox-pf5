<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutComponent\AddLayoutComponent;
use Neutron\Core\Form\Admin\LayoutComponent\EditLayoutComponent;
use Neutron\Core\Model\LayoutComponent;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminComponentController extends AdminController
{
    public function afterInitialize()
    {
        _get('html.title')->set(_text('Components', 'admin'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.component'),
                'label' => _text('Component', 'admin'),
            ]);

        _get('menu.admin.secondary')->load('admin','appearance');

    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('_core.component.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => LayoutComponent::class,
            'template' => 'core/admin-layout/manage-layout-component',
        ]))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => LayoutComponent::class,
            'form'     => AddLayoutComponent::class,
            'redirect' => _url('admin.core.layout.component'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'action_id',
            'model'    => LayoutComponent::class,
            'form'     => EditLayoutComponent::class,
            'redirect' => _url('admin.core.layout.component'),
        ]))->process();
    }
}