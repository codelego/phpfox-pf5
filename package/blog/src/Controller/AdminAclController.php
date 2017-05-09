<?php

namespace Neutron\Blog\Controller;

use Neutron\Core\Controller\AdminController;

class AdminAclController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()->add(_text('Blogs'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        _service('menu.admin.secondary')->load('admin.blog');

    }

    public function actionIndex()
    {

    }
}