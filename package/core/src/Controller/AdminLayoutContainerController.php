<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\AddLayoutContainer;
use Neutron\Core\Form\EditLayoutContainer;
use Neutron\Core\Model\LayoutContainer;
use Phpfox\View\ViewModel;

class AdminLayoutContainerController extends AdminController
{
    protected function initialized()
    {
        _service('menu.admin.secondary')
            ->load('admin.core.layout');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $id = $request->get('container_id');
        /** @var LayoutContainer $container */
        $container = _find('layout_container', $id);
        $page = _find('layout_page', $container->getPageId());

        $form = new EditLayoutContainer();

        $form->setAction(_url('admin.core.layout.action',
            ['container_id' => $id, 'action' => 'edit-container']));

        if ($request->isGet()) {
            $form->populate($container);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $container->fromArray($form->getData());

            $container->save();

            _service('cache.local')->flush();

            _service('response')
                ->redirect(_url('admin.core.layout.design-page',
                    ['action_id' => $page->getActionId()]));
        }

        return new ViewModel(['form' => $form, 'heading' => 'Add Container'],
            'layout/form-edit');
    }

    public function actionAdd()
    {
        $request = _service('request');
        $pageId = $request->get('page_id');
        $page = _service('layout_loader')->findPageById($pageId);
        $form = new AddLayoutContainer();

        $form->setAction(_url('admin.core.layout.action', ['action' => 'add-container', 'page_id' => $pageId]));

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $data['page_id'] = $pageId;

            $entry = new LayoutContainer($data);
            $entry->save();

            _service('response')
                ->redirect(_url('admin.core.layout.design-page',
                    ['action_id' => $page->getActionId()]));
        }

        return new ViewModel(['form' => $form, 'heading' => 'Add Container'],
            'layout/form-edit');
    }

    public function actionDelete()
    {
        $request = _service('request');
        $containerId = $request->get('container_id');

        _service('layout_loader')->deleteContainers([$containerId]);
    }
}