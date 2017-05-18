<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutComponent\AddLayoutComponent;
use Neutron\Core\Form\Admin\LayoutComponent\EditLayoutComponent;
use Neutron\Core\Model\LayoutComponent;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminLayoutComponentController extends AdminController
{
    public function initialized()
    {
        $editingThemeId = _get('core.layout')
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
            ->load('_core.layout');

    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('_core.layout.component.buttons');
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