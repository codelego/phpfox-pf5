<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutBlock\AddLayoutBlock;
use Neutron\Core\Form\Admin\LayoutBlock\EditLayoutBlock;
use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutBlockController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('menu.admin.secondary')
            ->load('_core.layout');
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');
        $locationId = $request->get('location_id');
        $containerId = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = \Phpfox::find('layout_container', $containerId);

        /** @var LayoutPage $page */
        $page = \Phpfox::find('layout_page', $container->getPageId());

        $form = new AddLayoutBlock([
            'locationId'  => $locationId,
            'containerId' => $containerId,
        ]);

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = array_merge($form->getData(), [
                'location_id'  => $locationId,
                'container_id' => $containerId,
                'is_active'    => 1,
                'ordering'     => 0,
                'params'       => '[]',
            ]);

            /** @var LayoutBlock $entry */
            $entry = \Phpfox::model('layout_block')
                ->create($data);

            $entry->save();

            \Phpfox::get('shared.cache')->flush();

            \Phpfox::redirect('admin.core.layout.page', [
                'action'    => 'design',
                'action_id' => $page->getActionId(),
            ]);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');

    }

    public function actionEdit()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $form = new EditLayoutBlock([]);

        /** @var LayoutBlock $entry */
        $entry = \Phpfox::model('layout_block')->findById($id);

        if ($request->isGet()) {
            $form->populate($entry);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->fromArray($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionEnable()
    {
        $request = \Phpfox::get('request');
        $blockId = $request->get('block_id');

        /** @var LayoutBlock $block */
        $block = \Phpfox::find('layout_block', $blockId);

        $container = \Phpfox::find('layout_container', $block->getContainerId());

        /** @var LayoutPage $page */
        $page = \Phpfox::find('layout_page', $container->getPageId());

        $block->setActive(1);
        $block->save();

        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.layout.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }

    public function actionSettings()
    {
        $request = \Phpfox::get('request');
        $blockId = $request->get('block_id');

        /** @var LayoutBlock $block */
        $block = \Phpfox::find('layout_block', $blockId);

        $container = \Phpfox::find('layout_container', $block->getContainerId());

        /** @var LayoutPage $page */
        $page = \Phpfox::find('layout_page', $container->getPageId());

        $block->setActive(1);
        $block->save();

        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.layout.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }

    public function actionDisable()
    {
        $request = \Phpfox::get('request');
        $blockId = $request->get('block_id');

        /** @var LayoutBlock $block */
        $block = \Phpfox::find('layout_block', $blockId);

        $container = \Phpfox::find('layout_container', $block->getContainerId());

        /** @var LayoutPage $page */
        $page = \Phpfox::find('layout_page', $container->getPageId());

        $block->setActive(0);
        $block->save();

        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.layout.action.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);

    }

    public function actionDelete()
    {
        $request = \Phpfox::get('request');
        $blockId = $request->get('block_id');

        /** @var LayoutBlock $block */
        $block = \Phpfox::find('layout_block', $blockId);

        $container = \Phpfox::find('layout_container', $block->getContainerId());
        /** @var LayoutPage $page */
        $page = \Phpfox::find('layout_page', $container->getPageId());

        $block->delete();

        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.layout.action.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }
}