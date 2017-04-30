<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\ThemeEditor;
use Phpfox\View\ViewModel;

class AdminThemeController extends AdminController
{
    protected function initialized()
    {
        \Phpfox::get('breadcrumb')->add(['label' => 'Themes']);
    }

    public function actionIndex()
    {
        $request = \Phpfox::get('request');

        $cmd = $request->get('cmd');
        $id = $request->get('id');

        try {
            if ($id) {
                switch ($cmd) {
                    case 'default':
                        \Phpfox::get('core.themes')
                            ->setDefault($id);
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
            }
        } catch (\Exception $ex) {
            exit($ex->getMessage());
        }


        $items = \Phpfox::with('theme')
            ->select('*')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-theme/index');
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
            'heading' => '',
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionDebug()
    {
        $vm = new ViewModel();

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
}