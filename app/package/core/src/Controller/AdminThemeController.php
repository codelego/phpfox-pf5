<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\ThemeEditor;
use Phpfox\View\ViewModel;

class AdminThemeController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')->set(_text('Themes', 'admin'));

        \Phpfox::get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.theme'),
                'label' => _text('Themes', 'admin'),
            ]);

        \Phpfox::get('menu.admin.secondary')->load('admin', 'appearance');
    }

    /**
     * @return ViewModel
     */
    public function actionIndex()
    {
        $request = \Phpfox::get('request');

        $cmd = $request->get('cmd');
        $themeId = $request->get('theme_id');

        try {
            if ($themeId and $cmd) {
                switch ($cmd) {
                    case 'default':
                        \Phpfox::get('core.themes')
                            ->setDefault($themeId);
                        break;
                    case 'editing':
                        \Phpfox::get('core.themes')
                            ->setEditing($themeId);
                        break;
                    case 'active':
                        \Phpfox::get('core.themes')
                            ->setActive($themeId);
                        break;
                    case 'inactive':
                        \Phpfox::get('core.themes')
                            ->setInactive($themeId);
                        break;
                    case 'rebuild-main':
                        \Phpfox::get('core.themes')
                            ->rebuildMain($themeId);
                        break;
                    case 'rebuild-files':
                        \Phpfox::get('core.themes')
                            ->rebuildFiles($themeId);
                }
                \Phpfox::get('response')
                    ->redirect(_url('admin.core.layout.theme', []));
            }
        } catch (\Exception $ex) {
            exit($ex->getMessage());
        }


        $items = \Phpfox::model('layout_theme')
            ->select('*')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-layout/manage-theme');
    }

    /**
     * Edit theme
     */
    public function actionEdit()
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
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionDebug()
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
            $key = str_replace(PHPFOX_APP_DIR, '/', $key);
            $value = str_replace(PHPFOX_APP_DIR, '/', $value);

            $files[$key] = $value;
        }

        foreach ($paths as $index => $value) {
            $paths[$index] = str_replace(PHPFOX_APP_DIR, '/', $value);
        }

        return new ViewModel([
            'files'     => $files,
            'main'      => $main,
            'paths'     => $paths,
            'variables' => $variables,
        ], 'core/admin-layout/debug-theme');
    }
}