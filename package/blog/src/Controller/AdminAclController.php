<?php

namespace Neutron\Blog\Controller;

use Neutron\Core\Controller\AdminController;

class AdminAclController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Blogs'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        _get('menu.admin.buttons')->load('_blog.buttons');
        _get('menu.admin.secondary')->load('admin','blog');

    }

    public function actionIndex()
    {

    }
}