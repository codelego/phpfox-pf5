<?php

namespace Neutron\Pages\Controller;


use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminEditPermissionProcess;

class AdminPermissionController extends AdminController
{
    protected function afterInitialize()
    {
        _get('breadcrumb')
            ->set(['href' => _url('admin.pages'), 'label' => _text('Pages', 'admin')])
            ->add([
                'href'  => _url('admin.pages.permission'),
                'label' => _text('Permissions', 'admin'),
            ]);

        _get('html.title')
            ->set(_text('Pages', 'admin'));

        _get('menu.admin.secondary')->load('admin', 'pages');

        _get('menu.admin.buttons')->load('_pages.buttons');
    }

    public function actionIndex()
    {
        return (new AdminEditPermissionProcess([
            'itemType'   => 'pages',
            'levelModel' => 'pages_level',
        ]))->process();
    }
}