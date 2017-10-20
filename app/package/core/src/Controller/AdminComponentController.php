<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutComponent\DeleteLayoutComponent;
use Neutron\Core\Form\Admin\LayoutComponent\EditLayoutComponent;
use Neutron\Core\Form\Admin\LayoutComponent\FilterLayoutComponent;
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

        _get('menu.admin.secondary')->load('admin', 'appearance');

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
            'filter.form' => FilterLayoutComponent::class,
            'model'       => LayoutComponent::class,
            'select'      => _model('layout_component')->select()->order('package_id,component_name', 1),
            'template'    => 'core/admin-layout/manage-component',
            'noLimit'     => true,
        ]))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => LayoutComponent::class,
            'form'     => DeleteLayoutComponent::class,
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