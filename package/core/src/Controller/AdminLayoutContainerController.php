<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutContainer\AddLayoutContainer;
use Neutron\Core\Form\Admin\LayoutContainer\EditLayoutContainer;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutContainerController extends AdminController
{
    protected function initialized()
    {
        _get('menu.admin.secondary')
            ->load('admin.core.layout');
    }

    public function actionEdit()
    {
        $request = _get('request');
        $id = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = _find('layout_container', $id);

        $page = _find('layout_page', $container->getPageId());

        $form = new EditLayoutContainer(['pageId' => $page->getId()]);

        if ($request->isGet()) {
            $form->populate($container);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $container->fromArray($form->getData());

            $container->save();

            _get('cache.local')->flush();

            _redirect('admin.core.layout.page', [
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
        $request = _get('request');
        $pageId = $request->get('page_id');
        $page = _get('layout_loader')->findPageById($pageId);

        $form = new AddLayoutContainer(['pageId' => $pageId,]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $data['page_id'] = $pageId;

            $entry = new LayoutContainer($data);
            $entry->save();

            _redirect('admin.core.layout.page', [
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
        $request = _get('request');
        $containerId = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = _model('layout_container')
            ->findById($containerId);

        /** @var LayoutPage $page */
        $page = _model('layout_page')
            ->findById($container->getPageId());

        $container->setActive($container->isActive() ? 0 : 1);
        $container->save();

        _get('cache.local')->flush();

        _redirect('admin.core.layout.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }

    public function actionDelete()
    {
        $request = _get('request');
        $containerId = $request->get('container_id');

        /** @var LayoutContainer $container */
        $container = _model('layout_container')
            ->findById($containerId);

        /** @var LayoutPage $page */
        $page = _model('layout_page')
            ->findById($container->getPageId());

        _get('layout_loader')->deleteContainers([$containerId]);


        _get('cache.local')->flush();

        _redirect('admin.core.layout.page', [
            'action'    => 'design',
            'action_id' => $page->getActionId(),
        ]);
    }
}