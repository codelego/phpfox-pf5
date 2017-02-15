<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\ThemeEditor;
use Phpfox\View\ViewModel;

class AdminThemeController extends AdminController
{
    public function actionIndex()
    {
        $request = \Phpfox::get('mvc.request');

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
        $vm = new ViewModel();
        $form = new ThemeEditor();
        $request = \Phpfox::get('mvc.request');
        $id = $request->get('id');


        $params = [];
        $custom = \Phpfox::get('core.themes')
            ->findSettingByThemeId($id);

        if ($custom) {
            $params = json_decode($custom['params'], true);
        }

        $form->populate($params);

        $vm->assign([
            'heading' => '',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout/admin-edit');

        return $vm;
    }

    public function actionDebug()
    {
        $vm = new ViewModel();

        $request = \Phpfox::get('mvc.request');
        $id = $request->get('id');
        $theme = \Phpfox::get('core.themes')
            ->findById($id);

        if (!$id) {
            $id = 'default';
            $theme = \Phpfox::get('core.themes')
                ->findById($id);
        }

        $vm->setTemplate('core/admin-theme/debug');

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

        $vm->assign([
            'files'     => $files,
            'main'      => $main,
            'paths'     => $paths,
            'variables' => $variables,
        ]);

        return $vm;
    }
}