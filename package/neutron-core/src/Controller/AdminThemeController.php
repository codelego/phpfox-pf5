<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\ThemeEditor;
use Phpfox\Assets\StylesheetCompiler;
use Phpfox\View\ViewModel;

class AdminThemeController extends AdminController
{
    public function actionIndex()
    {
        $request = \Phpfox::get('mvc.request');

        $cmd = $request->get('cmd');
        $id = $request->get('id');

        if($id){
            switch($cmd){
                case 'default':
                    \Phpfox::get('core.themes')
                        ->setDefault($id);
                    break;
                case 'active':
                    \Phpfox::get('core.themes')
                        ->active($id);
                    break;
                case 'inactive':
                    \Phpfox::get('core.themes')
                        ->inactive($id);
                    break;
                case 'rebuild':
                    \Phpfox::get('core.themes')
                        ->rebuild($id);
            }
        }

        $items = \Phpfox::getModel('core_theme')
            ->select('*')
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $items,
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
}