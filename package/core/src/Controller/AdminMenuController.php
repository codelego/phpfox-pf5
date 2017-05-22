<?php

namespace Neutron\Core\Controller;


use Phpfox\View\ViewModel;

class AdminMenuController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Menus', '_core'));

        _get('breadcrumb')
            ->set([
                'href'  => _url('admin.core.menu'),
                'label' => _text('Menus', '_core'),
            ]);

        _get('menu.admin.secondary')->load('admin','appearance');
    }

    public function actionIndex()
    {
        $items = _model('core_menu')
            ->select()
            ->where('is_admin=?', 0)
            ->where('package_id in ?', _get('package.loader')->getActivePackageIds())
            ->all();

        return new ViewModel([
            'items' => $items,
        ], 'core/admin-menu/manage-menu');
    }
}