<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutContainer\AddLayoutContainer;
use Neutron\Core\Form\Admin\LayoutContainer\EditLayoutContainer;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutContainerController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('menu.admin.secondary')
            ->load('_core.layout');
    }

    public function actionEdit()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = \Phpfox::find('layout_container', $id);

        $page = \Phpfox::find('layout_page', $container->getPageId());

        $form = new EditLayoutContainer(['pageId' => $page->getId()]);

        if ($request->isGet()) {
            $form->populate($container);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $container->fromArray($form->getData());

            $container->save();

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

    public function actionAdd()
    {
        $request = \Phpfox::get('request');
        $pageId = $request->get('page_id');
        $page = \Phpfox::get('core.layout')->findPageById($pageId);

        $form = new AddLayoutContainer(['pageId' => $pageId,]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $data['page_id'] = $pageId;

            $entry = new LayoutContainer($data);
            $entry->save();

            \Phpfox::redirect('admin.core.layout.page', [
                'action'    => 'design',
                'action_id' => $page->getActionId(),
            ]);
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionToggle()
    {
        $request = \Phpfox::get('request');
        $containerId = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = \Phpfox::model('layout_container')
            ->findById($containerId);

        /** @var LayoutPage $page */
        $page = \Phpfox::model('layout_page')
            ->findById($container->getPageId());

        $container->setActive($container->isActive() ? 0 : 1);
        $container->save();

        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.layout.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }

    public function actionDelete()
    {
        $request = \Phpfox::get('request');
        $containerId = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = \Phpfox::model('layout_container')
            ->findById($containerId);

        /** @var LayoutPage $page */
        $page = \Phpfox::model('layout_page')
            ->findById($container->getPageId());

        \Phpfox::get('core.layout')->deleteContainers([$containerId]);


        \Phpfox::get('shared.cache')->flush();

        \Phpfox::redirect('admin.core.layout.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }
}