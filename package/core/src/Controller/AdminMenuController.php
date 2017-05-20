<?php

namespace Neutron\Core\Controller;


use Phpfox\View\ViewModel;

class AdminMenuController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Menu Editor', '_core'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.menu'),
                'label' => _text('Menu Editor', '_core'),
            ]);

        _get('menu.admin.secondary')
            ->load('_core.menu');
    }

    public function actionIndex()
    {
        $items = _get('db')
            ->select('distinct menu')
            ->from(':core_menu')
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-menu/manage-menu');
    }
}