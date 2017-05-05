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
use Neutron\Core\Model\LayoutComponent;
use Neutron\Core\Model\LayoutContainer;
use Neutron\Core\Model\LayoutPage;
use Phpfox\View\ViewModel;

class AdminLayoutController extends AdminController
{
    public function initialized()
    {
        $editingThemeId = _service('layout_loader')->getEditingThemeId();

        _service('breadcrumb')
            ->clear()
            ->add([
                'href'  => _url('admin.core.layout'),
                'label' => _text('Layout Editor {0}', 'admin', null,
                    [$editingThemeId]),
            ]);

        _service('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => _text('Manage Pages', 'admin'),
                'href'  => _url('admin.core.layout'),
            ])->add([
                'label' => _text('Manage Themes', 'admin'),
                'href'  => _url('admin.core.layout.action', ['action' => 'manage-theme']),
            ])
            ->add([
                'label' => _text('Manage Components', 'admin'),
                'href'  => _url('admin.core.layout.action', ['action' => 'manage-component']),
            ]);

        if (PHPFOX_IS_DEV) {
            _service('menu.admin.secondary')->add([
                'label' => _text('Add Page', 'admin'),
                'href'  => _url('admin.core.layout.action', ['action' => 'add-page']),
                'extra' => [
                    'data-cmd' => 'modal',
                    'class'    => 'btn btn-default',
                ],
            ])->add([
                'label' => _text('Add Component', 'admin'),
                'href'  => _url('admin.core.layout.action', ['action' => 'add-component']),
                'extra' => [
                    'data-cmd' => 'modal',
                    'class'    => 'btn btn-default',
                ],
            ]);
        }
    }

    public function actionIndex()
    {
        $items = _with('layout_action')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-page');
    }

    public function actionAddPage()
    {
        $request = _service('request');

        $form = new AddLayoutAction([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutAction $entry */
            $entry = _with('layout_page')->create($form->getData());
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Edit Component', 'admin'),
        ], 'layout/form-edit');
    }

    public function actionEditPage()
    {
        $request = _service('request');
        $actionId = $request->get('action_id');

        $form = new EditLayoutAction(['actionId' => $actionId]);

        /** @var LayoutAction $entry */
        $entry = _with('layout_action')->findById($actionId);

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
        $request = _service('request');

        $cmd = $request->get('cmd');
        $themeId = $request->get('theme_id');

        try {
            if ($themeId and $cmd) {
                switch ($cmd) {
                    case 'default':
                        _service('core.themes')
                            ->setDefault($themeId);
                        break;
                    case 'editing':
                        _service('core.themes')
                            ->setEditing($themeId);
                        break;
                    case 'active':
                        _service('core.themes')
                            ->setActive($themeId);
                        break;
                    case 'inactive':
                        _service('core.themes')
                            ->setInactive($themeId);
                        break;
                    case 'rebuild-main':
                        _service('core.themes')
                            ->rebuildMain($themeId);
                        break;
                    case 'rebuild-files':
                        _service('core.themes')
                            ->rebuildFiles($themeId);
                }
                _service('response')
                    ->redirect(_url('admin.core.layout.action', ['action' => 'manage-theme']));
            }
        } catch (\Exception $ex) {
            exit($ex->getMessage());
        }


        $items = _with('layout_theme')
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
        $request = _service('request');
        $id = $request->get('id');


        $params = [];
        $custom = _service('core.themes')
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
        $request = _service('request');
        $id = $request->get('id');
        $theme = _service('core.themes')
            ->findById($id);

        if (!$id) {
            $id = 'default';
            $theme = _service('core.themes')
                ->findById($id);
        }

        $themes = _service('core.themes');

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
        ], 'core/admin-layout/debug-theme');
    }

    public function actionManageComponent()
    {
        $items = _with('layout_component')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-component');
    }

    public function actionAddComponent()
    {
        $request = _service('request');

        $form = new AddLayoutComponent([]);

        if ($request->isGet()) {
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            /** @var LayoutBlock $entry */
            $entry = _with('layout_component')
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
        $request = _service('request');
        $componentId = $request->get('component_id');

        $form = new EditLayoutComponent([]);

        /** @var LayoutComponent $entry */
        $entry = _with('layout_component')->findById($componentId);

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

    /**
     * List element of pages
     */
    public function actionDesignPage()
    {

        $request = _service('request');
        $actionId = $request->get('action_id');
        $themeId = $request->get('theme_id', 'default');

        $layoutService = _service('layout_loader');

        $pageId = $layoutService->findPageIdForEdit($actionId, $themeId);

        $layoutContent = $layoutService->loadForEdit($actionId, $themeId);


        if (!$layoutContent) {
            _service('response')
                ->redirect(_url('admin.core.layout.action',
                    ['action' => 'clone-page', 'action_id' => $actionId, 'theme_id' => $themeId]));
        }


        _service('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => 'Add Container',
                'extra' => [
                    'class'    => 'btn btn-success',
                    'data-cmd' => 'modal',
                    'href'     => _url('admin.core.layout.action',
                        ['action' => 'add-container', 'page_id' => $pageId]),
                ],
            ]);

        _service('require_js')
            ->deps('package/core/layout-editor');

        return new ViewModel(['layoutPage' => $layoutContent,],
            'core/admin-layout/design-page');
    }

    public function actionAddBlock()
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
            $entry = _with('layout_block')
                ->create($data);

            $entry->save();

            _service('cache.local')->flush();

            _redirect('admin.core.layout.design-page',
                ['action_id' => $page->getActionId()]);
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Add Block', 'admin'),
        ], 'layout/form-edit');

    }

    public function actionEditBlock()
    {
        $request = _service('request');
        $id = $request->get('id');

        $form = new EditLayoutBlock([]);

        /** @var LayoutBlock $entry */
        $entry = _with('layout_block')->findById($id);

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

    public function actionDeleteBlock()
    {
        $request = _service('request');
        $blockId = $request->get('block_id');

        /** @var LayoutBlock $block */
        $block = _find('layout_block', $blockId);
        $container = _find('layout_container', $block->getContainerId());
        /** @var LayoutContainer $page */
        $page = _find('layout_page', $container->getPageId());

        $block->delete();

        _service('cache.local')->flush();

        _redirect('admin.core.layout.action', [
            'action'    => 'design-page',
            'action_id' => $page->getActionId(),
        ]);
    }

    public function actionEditContainer()
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

    public function actionAddContainer()
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

    public function actionDeleteContainer()
    {
        $request = _service('request');
        $containerId = $request->get('container_id');

        _service('layout_loader')->deleteContainers([$containerId]);
    }

    public function actionClonePage()
    {
        $request = _service('request');
        $actionId = $request->get('action_id');
        $themeId = $request->get('theme_id');
        $confirmed = $request->get('confirmed', false);
        $layoutService = _service('layout_loader');
        $parentPageId = $layoutService->findPageIdForRender($actionId, $themeId);
        /** @var LayoutPage $parentPage */
        $parentPage = _with('layout_page')->findById($parentPageId);

        if ($confirmed) {
            $layoutService->clonePage($actionId, $themeId);
            _service('response')
                ->redirect(_url('admin.core.layout.design-page', ['action_id' => $actionId]));
        }

        return new ViewModel([
            'themeId'    => $themeId,
            'actionId'   => $actionId,
            'parentPage' => $parentPage,
        ], 'core/admin-layout/clone-page');
    }
}