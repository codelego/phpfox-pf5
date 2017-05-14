<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutComponent\AddLayoutComponent;
use Neutron\Core\Form\Admin\LayoutComponent\EditLayoutComponent;
use Neutron\Core\Model\LayoutComponent;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminLayoutComponentController extends AdminController
{
    public function initialized()
    {
        $editingThemeId = _get('layout_loader')
            ->getEditingThemeId();

        _get('html.title')
            ->set(_text('Layout Editor', 'admin'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.layout'),
                'label' => _text('Layout Editor {0}', 'admin', null,
                    [$editingThemeId]),
            ]);

        _get('menu.admin.secondary')
            ->load('admin.core.layout');

    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('admin.core.layout.component.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
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