<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddLayoutBlock;
use Neutron\Core\Form\EditLayoutBlock;
use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutBlockController extends AdminController
{
    protected function initialized()
    {
        _service('menu.admin.secondary')
            ->load('admin.core.layout');
    }

    public function actionAdd()
    {
        $request = _service('request');
        $locationId = $request->get('location_id');
        $containerId = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = _find('layout_container', $containerId);

        /** @var LayoutPage $page */
        $page = _find('layout_page', $container->getPageId());

        $form = new AddLayoutBlock();

        $form->setAction(_url('admin.core.layout.action', [
            'action'       => 'add-block',
            'location_id'  => $locationId,
            'container_id' => $containerId,
        ]));

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = array_merge($form->getData(), [
                'location_id'  => $locationId,
                'container_id' => $containerId,
                'is_active'    => 1,
                'sort_order'   => 0,
                'params'       => '[]',
            ]);

            /** @var LayoutBlock $entry */
            $entry = _model('layout_block')
                ->create($data);

            $entry->save();

            _service('cache.local')->flush();

            _redirect('admin.core.layout.design-page',
                ['action_id' => $page->getActionId()]);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');

    }

    public function actionEdit()
    {
        $request = _service('request');
        $id = $request->get('id');

        $form = new EditLayoutBlock([]);

        /** @var LayoutBlock $entry */
        $entry = _model('layout_block')->findById($id);

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

    public function actionDelete()
    {
        $request = _service('request');
        $blockId = $request->get('block_id');

        /** @var LayoutBlock $block */
        $block = _find('layout_block', $blockId);
        $container = _find('layout_container', $block->getContainerId());
        /** @var LayoutPage $page */
        $page = _find('layout_page', $container->getPageId());

        $block->delete();

        _service('cache.local')->flush();

        _redirect('admin.core.layout.action', [
            'action'    => 'design-page',
            'action_id' => $page->getActionId(),
        ]);
    }
}