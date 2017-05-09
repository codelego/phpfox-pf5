<?php

namespace Neutron\Core\Controller;

use Neutron\Core\Form\ThemeEditor;
use Phpfox\View\ViewModel;

class AdminLayoutThemeController extends AdminController
{
    protected function initialized()
    {
        _service('menu.admin.secondary')
            ->load('admin.core.layout');
    }

    /**
     * @return ViewModel
     */
    public function actionIndex()
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
                    ->redirect(_url('admin.core.layout.theme', []));
            }
        } catch (\Exception $ex) {
            exit($ex->getMessage());
        }


        $items = _model('layout_theme')
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
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionDebug()
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
}