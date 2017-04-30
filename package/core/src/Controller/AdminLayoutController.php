<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddLayoutBlock;
use Neutron\Core\Form\AddLayoutPage;
use Neutron\Core\Form\EditLayoutBlock;
use Neutron\Core\Form\EditLayoutPage;
use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutController extends AdminController
{
    public function initialized()
    {
        \Phpfox::get('breadcrumb')
            ->add(['label' => 'Layout Editor']);

        \Phpfox::get('menu.admin.secondary')
            ->add([
                'label' => 'Pages',
                'href'  => _url('admin.core.layout'),
            ])
            ->add([
                'label' => 'Components',
                'href'  => _url('admin.core.layout.component'),
            ])->add([
                'label' => 'Add Page',
                'href'  => _url('admin.core.layout.add'),
            ])->add([
                'label' => 'Add Component',
                'href'  => _url('admin.core.layout.add-component'),
            ]);
    }

    public function actionIndex()
    {
        $items = \Phpfox::with('layout_page')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-page');
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');

        $form = new AddLayoutPage([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutPage $entry */
            $entry = \Phpfox::with('layout_page')->create($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $form = new EditLayoutPage([]);

        /** @var LayoutPage $entry */
        $entry = \Phpfox::with('layout_page')->findById($id);

        if ($request->isGet()) {
            $form->populate($entry);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->fromArray($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Edit Layout Page', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionComponent()
    {
        $items = \Phpfox::with('layout_block')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-component');
    }

    public function actionAddComponent()
    {
        $request = \Phpfox::get('request');

        $form = new AddLayoutBlock([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutBlock $entry */
            $entry = \Phpfox::with('layout_block')->create($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionEditComponent()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $form = new EditLayoutBlock([]);

        /** @var LayoutBlock $entry */
        $entry = \Phpfox::with('layout_block')->findById($id);

        if ($request->isGet()) {
            $form->populate($entry);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->fromArray($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }

    /**
     * List element of pages
     */
    public function actionElement()
    {
        $request = \Phpfox::get('request');
        $pageId = $request->get('id');

        \Phpfox::get('require_js')
            ->deps('jscript/core/table-sortable');

        $locations = \Phpfox::get('layout_loader')->loadForEdit($pageId,
            'default');

        return new ViewModel(['locations' => $locations,],
            'core/admin-layout/manage-element');
    }

    public function actionEditElement()
    {

    }
}