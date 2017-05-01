<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\AddLayoutAction;
use Neutron\Core\Form\AddLayoutBlock;
use Neutron\Core\Form\AddLayoutComponent;
use Neutron\Core\Form\AddLayoutElement;
use Neutron\Core\Form\AddLayoutPage;
use Neutron\Core\Form\EditLayoutAction;
use Neutron\Core\Form\EditLayoutBlock;
use Neutron\Core\Form\EditLayoutComponent;
use Neutron\Core\Form\EditLayoutPage;
use Neutron\Core\Form\ThemeEditor;
use Neutron\Core\Model\LayoutAction;
use Neutron\Core\Model\LayoutBlock;
use Neutron\Core\Model\LayoutElement;
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
            ])->add([
                'label' => _text('Add Component', 'admin'),
                'href'  => _url('admin.core.layout.add-component'),
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
    public function actionDesign()
    {
        $request = \Phpfox::get('request');
        $actionId = $request->get('id');

        \Phpfox::get('require_js')
            ->deps('jscript/core/layout-editor');

        $layoutPage = \Phpfox::get('layout_loader')
            ->loadForEdit($actionId, 'default');

        \Phpfox::get('menu.admin.secondary')
            ->clear()
            ->add([
                'label' => 'Add Container',
                'href'  => '#' . $layoutPage->getName(),
                'extra' => [
                    'class'    => 'btn btn-success',
                    'data-cmd' => 'modal',
                    'data-url' => '#',
                ],
            ]);

        return new ViewModel(['layoutPage' => $layoutPage,],
            'core/admin-layout/manage-element');
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
}