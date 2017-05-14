<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\Admin\LayoutAction\AddLayoutAction;
use Neutron\Core\Form\Admin\LayoutAction\EditLayoutAction;
use Neutron\Core\Model\LayoutAction;
use Neutron\Core\Model\LayoutPage;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminEditEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminLayoutPageController extends AdminController
{
    public function initialized()
    {
        $editingThemeId = _get('layout_loader')
            ->getEditingThemeId();

        _get('html.title')
            ->set(_text('Layout Editor', 'admin'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.layout'),
                'label' => _text('Layout Editor {0}', 'admin', null,
                    [$editingThemeId]),
            ]);

        _get('menu.admin.secondary')
            ->load('_core.layout');

    }

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')
                ->load('_core.layout.page.buttons');
        }
    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
            'model'    => LayoutAction::class,
            'template' => 'core/admin-layout/manage-layout-page',
        ]))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'model'    => LayoutAction::class,
            'form'     => AddLayoutAction::class,
            'redirect' => _url('admin.core.layout'),
        ]))->process();
    }


    public function actionEdit()
    {
        return (new AdminEditEntryProcess([
            'key'      => 'action_id',
            'model'    => LayoutAction::class,
            'form'     => EditLayoutAction::class,
            'redirect' => _url('admin.core.layout'),
        ]))->process();
    }

    /**
     * List element of pages
     */
    public function actionDesign()
    {

        $request = _get('request');
        $actionId = $request->get('action_id');
        $themeId = $request->get('theme_id', 'default');

        $layoutService = _get('layout_loader');

        $pageId = $layoutService->findPageIdForEdit($actionId, $themeId);

        $layoutContent = $layoutService->loadForEdit($actionId, $themeId);


        if (!$layoutContent) {
            _get('response')
                ->redirect(_url('admin.core.layout.action',
                    ['action' => 'clone-page', 'action_id' => $actionId, 'theme_id' => $themeId]));
        }


        _get('menu.admin.buttons')
            ->add([
                'label' => 'Add Container',
                'extra' => [
                    'class'    => 'btn btn-danger',
                    'data-cmd' => 'modal',
                    'href'     => _url('admin.core.layout.container',
                        ['action' => 'add', 'page_id' => $pageId]),
                ],
            ]);

        _get('require_js')
            ->deps('package/core/layout-editor');

        return new ViewModel(['layoutPage' => $layoutContent,],
            'core/admin-layout/design-page');
    }


    public function actionClone()
    {
        $request = _get('request');
        $actionId = $request->get('action_id');
        $themeId = $request->get('theme_id');
        $confirmed = $request->get('confirmed', false);
        $layoutService = _get('layout_loader');
        $parentPageId = $layoutService->findPageIdForRender($actionId, $themeId);
        /** @var LayoutPage $parentPage */
        $parentPage = _model('layout_page')->findById($parentPageId);

        if ($confirmed) {
            $layoutService->clonePage($actionId, $themeId);
            _get('response')
                ->redirect(_url('admin.core.layout.design-page', ['action_id' => $actionId]));
        }

        return new ViewModel([
            'themeId'    => $themeId,
            'actionId'   => $actionId,
            'parentPage' => $parentPage,
        ], 'core/admin-layout/clone-page');
    }
}