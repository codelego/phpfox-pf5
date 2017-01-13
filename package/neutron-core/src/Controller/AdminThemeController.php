<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\ThemeEditor;
use Phpfox\Action\ActionController;
use Phpfox\Assets\StylesheetCompiler;
use Phpfox\View\ViewModel;

class AdminThemeController extends ActionController
{
    public function actionIndex()
    {
        $db = \Phpfox::get('db');

        $packages = $db->select('*')
            ->from(':core_package')
            ->where('is_theme=1')
            ->order('is_core', -1)
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $packages,
        ]);
        $vm->setTemplate('core.admin-theme.index');

        return $vm;
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
        $custom = \Phpfox::get('db')
            ->select('*')
            ->from(':core_theme_setting')
            ->where('theme_id=?', $id)
            ->execute()
            ->first();

        if ($custom) {
            $params = json_decode($custom['params'], true);
        }

        $form->populate($params);

        $vm->assign([
            'heading' => '',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout.admin.edit');

        return $vm;
    }

    public function actionRebuild()
    {

        $request = \Phpfox::get('mvc.request');
        $id = $request->get('id');
        $name = $request->get('name');

        $compiler = new StylesheetCompiler();
        $compiler->rebuild($name);
    }
}