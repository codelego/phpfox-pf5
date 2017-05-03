<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddLayoutAction;
use Neutron\Core\Form\AddLayoutBlock;
use Neutron\Core\Form\AddLayoutComponent;
use Neutron\Core\Form\AddLayoutContainer;
use Neutron\Core\Form\EditLayoutAction;
use Neutron\Core\Form\EditLayoutBlock;
use Neutron\Core\Form\EditLayoutComponent;
use Neutron\Core\Form\EditLayoutContainer;
use Neutron\Core\Form\ThemeEditor;
use Neutron\Core\Model\LayoutAction;
use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutController extends AdminController
{
    public function initialized()
    {
        $editingThemeId = \Phpfox::get('layout_loader')->getEditingThemeId();

        \Phpfox::get('breadcrumb')
            ->clear()
            ->add([
                'href'  => '#',
                'label' => _text('Layout Editor {0}', 'admin', null,
                    [$editingThemeId]),
            ]);

        \Phpfox::get('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => _text('Manage Pages', 'admin'),
                'href'  => _url('admin.core.layout'),
            ])->add([
                'label' => _text('Manage Themes', 'admin'),
                'href'  => _url('admin.core.layout.manage-theme'),
            ])
            ->add([
                'label' => _text('Manage Components', 'admin'),
                'href'  => _url('admin.core.layout.manage-component'),
            ])->add([
                'label' => _text('Add Page', 'admin'),
                'href'  => _url('admin.core.layout.add'),
                'extra' => [
                    'data-cmd' => 'modal',
                    'class'    => 'btn btn-default',
                ],
            ])->add([
                'label' => _text('Add Component', 'admin'),
                'href'  => _url('admin.core.layout.add-component'),
                'extra' => [
                    'data-cmd' => 'modal',
                    'class'    => 'btn btn-default',
                ],
            ]);
    }

    public function actionIndex()
    {
        $items = \Phpfox::with('layout_action')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-page');
    }

    public function actionAdd()
    {
        $request = \Phpfox::get('request');

        $form = new AddLayoutAction([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutAction $entry */
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

        $form = new EditLayoutAction([]);

        /** @var LayoutAction $entry */
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

    /**
     * @return ViewModel
     */
    public function actionManageTheme()
    {
        $request = \Phpfox::get('request');

        $cmd = $request->get('cmd');
        $id = $request->get('id');

        try {
            if ($id and $cmd) {
                switch ($cmd) {
                    case 'default':
                        \Phpfox::get('core.themes')
                            ->setDefault($id);
                        break;
                    case 'editing':
                        \Phpfox::get('core.themes')
                            ->setEditing($id);
                        break;
                    case 'active':
                        \Phpfox::get('core.themes')
                            ->setActive($id);
                        break;
                    case 'inactive':
                        \Phpfox::get('core.themes')
                            ->setInactive($id);
                        break;
                    case 'rebuild-main':
                        \Phpfox::get('core.themes')
                            ->rebuildMain($id);
                        break;
                    case 'rebuild-files':
                        \Phpfox::get('core.themes')
                            ->rebuildFiles($id);
                }
                \Phpfox::get('response')
                    ->redirect(_url('admin.core.layout.manage-theme'));
            }
        } catch (\Exception $ex) {
            exit($ex->getMessage());
        }


        $items = \Phpfox::with('layout_theme')
            ->select('*')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-theme');
    }

    /**
     * Edit theme
     */
    public function actionEditTheme()
    {
        $form = new ThemeEditor();
        $request = \Phpfox::get('request');
        $id = $request->get('id');


        $params = [];
        $custom = \Phpfox::get('core.themes')
            ->findSettingByThemeId($id);

        if ($custom) {
            $params = json_decode($custom['params'], true);
        }

        $form->populate($params);

        return new ViewModel([
            'heading' => '',
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionDebugTheme()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');
        $theme = \Phpfox::get('core.themes')
            ->findById($id);

        if (!$id) {
            $id = 'default';
            $theme = \Phpfox::get('core.themes')
                ->findById($id);
        }

        $themes = \Phpfox::get('core.themes');

        $tempFiles = $themes->getRebuildFiles($theme->getId());
        $main = $themes->getMainSource();
        $paths = $themes->getImportPaths($theme->getId());
        $variables = $themes->getSassVariables($theme->getId());

        $files = [];

        foreach ($tempFiles as $key => $value) {
            $key = str_replace(PHPFOX_DIR, '/', $key);
            $value = str_replace(PHPFOX_DIR, '/', $value);

            $files[$key] = $value;
        }

        foreach ($paths as $index => $value) {
            $paths[$index] = str_replace(PHPFOX_DIR, '/', $value);
        }

        return new ViewModel([
            'files'     => $files,
            'main'      => $main,
            'paths'     => $paths,
            'variables' => $variables,
        ], 'core/admin-theme/debug');
    }

    public function actionManageComponent()
    {
        $items = \Phpfox::with('layout_component')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-component');
    }

    public function actionAddComponent()
    {
        $request = \Phpfox::get('request');

        $form = new AddLayoutComponent([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutBlock $entry */
            $entry = \Phpfox::with('layout_component')
                ->create($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'render'  => 'form_panel_horizontal',
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionEditComponent()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $form = new EditLayoutComponent([]);

        /** @var LayoutBlock $entry */
        $entry = \Phpfox::with('layout_component')->findById($id);

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
    public function actionDesignLayout()
    {
        $request = \Phpfox::get('request');
        $actionId = $request->get('action_id');
        $themeId = 'default';
        $containerId = $request->get('container_id');
        $cmd = $request->get('cmd');
        $layoutService = \Phpfox::get('layout_loader');

        switch ($cmd) {
            case 'delete_container':
                $layoutService->deleteContainers([$containerId]);
                \Phpfox::get('response')->redirect('?');
                break;
        }


        \Phpfox::get('require_js')
            ->deps('package/core/layout-editor');

        $layoutPage = $layoutService->loadForEdit($actionId, $themeId);

        if (!$layoutPage) {
            \Phpfox::get('response')
                ->redirect(_url('admin.core.layout.clone-page',
                    ['action_id' => $actionId, 'theme_id' => $themeId]));
        }

        \Phpfox::get('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => 'Add Container',
                'href'  => '#' . $layoutPage->getName(),
                'extra' => [
                    'class'    => 'btn btn-success',
                    'data-cmd' => 'modal',
                    'data-url' => _url('admin.core.layout.action',
                        ['action' => 'add-container', 'page_id' => $layoutPage->getName()]),
                ],
            ]);

        return new ViewModel(['layoutPage' => $layoutPage,],
            'core/admin-layout/design-layout');
    }

    public function actionAddBlock()
    {
        $request = \Phpfox::get('request');

        $form = new AddLayoutBlock([
            'pageId'     => $request->get('page_id'),
            'blockId'    => $request->get('block_id'),
            'locationId' => $request->get('locationId'),
        ]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutBlock $entry */
            $entry = \Phpfox::with('layout_block')->create($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Add Block', 'admin'),
        ], 'layout/form-edit');

    }

    public function actionEditBlock()
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
            'heading' => _text('Edit Block', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionEditContainer()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('container_id');
        $container = \Phpfox::findById('layout_container', $id);
        $page = \Phpfox::findById('layout_page', $container->getPageId());

        $form = new EditLayoutContainer();

        $form->setAction(_url('admin.core.layout.edit-container',
            ['container_id' => $id]));

        if ($request->isGet()) {
            $form->populate($container);
        }

        if ($request->isPost() and $form->isValid($request->all())) {

            $container->fromArray($form->getData());

            $container->save();

            \Phpfox::get('response')
                ->redirect(_url('admin.core.layout.design-layout',
                    ['action_id' => $page->getActionId()]));
        }

        return new ViewModel(['form' => $form, 'heading' => 'Add Container'],
            'layout/form-edit');
    }

    public function actionAddContainer()
    {
        $request = \Phpfox::get('request');
        $pageId = $request->get('page_id');
        $page = \Phpfox::get('layout_loader')->findPageById($pageId);
        $form = new AddLayoutContainer();

        $form->setAction(_url('admin.core.layout.add-container',
            ['page_id' => $pageId]));

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $data['page_id'] = $pageId;

            $entry = new LayoutContainer($data);
            $entry->save();

            \Phpfox::get('response')
                ->redirect(_url('admin.core.layout.design-layout',
                    ['action_id' => $page->getActionId()]));
        }

        return new ViewModel(['form' => $form, 'heading' => 'Add Container'],
            'layout/form-edit');
    }

    public function actionDeleteContainer()
    {
        $request = \Phpfox::get('request');
        $containerId = $request->get('container_id');

        \Phpfox::get('layout_loader')->deleteContainers([$containerId]);
    }

    public function actionClonePage()
    {
        $request = \Phpfox::get('request');
        $actionId = $request->get('action_id');
        $themeId = $request->get('theme_id');
        $confirmed = $request->get('confirmed', false);
        $layoutService = \Phpfox::get('layout_loader');
        $parentPageId = $layoutService->findPageIdForRender($actionId,
            $themeId);
        /** @var LayoutPage $parentPage */
        $parentPage = \Phpfox::with('layout_page')->findById($parentPageId);

        if ($confirmed) {
            $layoutService->clonePage($actionId, $themeId);
            \Phpfox::get('response')
                ->redirect(_url('admin.core.layout.design-layout',
                    ['action_id' => $actionId]));
        }

        return new ViewModel([
            'themeId'    => $themeId,
            'actionId'   => $actionId,
            'parentPage' => $parentPage,
        ], 'core/admin-layout/clone-page');
    }
}