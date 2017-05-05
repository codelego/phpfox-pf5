<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddLayoutComponent;
use Neutron\Core\Form\EditLayoutComponent;
use Neutron\Core\Model\LayoutComponent;
use Phpfox\View\ViewModel;

class AdminLayoutComponentController extends AdminController
{
    public function initialized()
    {
        _service('menu.admin.secondary')
            ->load('admin.core.layout');
    }

    public function actionIndex()
    {
        $items = _model('layout_component')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-component');
    }

    public function actionAdd()
    {
        $request = _service('request');

        $form = new AddLayoutComponent([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutComponent $entry */
            $entry = _model('layout_component')
                ->create($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'render'  => 'form_panel_horizontal',
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $componentId = $request->get('component_id');

        $form = new EditLayoutComponent([]);

        /** @var LayoutComponent $entry */
        $entry = _model('layout_component')->findById($componentId);

        if ($request->isGet()) {
            $form->populate($entry);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->fromArray($form->getData());
            $entry->save();

            _redirect('admin.core.layout.action', ['action' => 'manage-component']);
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }
}