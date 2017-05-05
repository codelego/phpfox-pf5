<?php

namespace Neutron\Blog\Controller;

use Neutron\Core\Controller\AdminController;

class AdminPostController extends AdminController
{
    protected function initialized()
    {
        _service('html.title')
            ->clear()
            ->add(_text('Blogs'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        _service('menu.admin.secondary')
            ->clear()
            ->add([
                'href'  => _url('admin.blog'),
                'label' => _text('Posts'),
            ])->add([
                'href'  => _url('admin.blog.category'),
                'label' => _text('Categories'),
            ])
            ->add([
                'href'  => _url('admin.blog.category', ['action' => 'add']),
                'label' => _text('Add Category'),
                'extra' => ['class' => 'btn btn-default', 'data-cmd' => 'modal', 'data-size' => 'lg'],
            ]);

    }

    public function actionIndex()
    {

    }
}