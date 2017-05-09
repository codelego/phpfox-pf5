<?php

namespace Neutron\Blog\Controller;


use Neutron\Blog\Form\Admin\BlogCategory\AddBlogCategory;
use Neutron\Blog\Form\Admin\BlogCategory\EditBlogCategory;
use Neutron\Blog\Model\BlogCategory;
use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminCategoryController extends AdminController
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

    protected function postDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _service('menu.admin.buttons')->load('admin.blog.category.buttons');
        }

    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
                'filter'   => null,
                'model'    => BlogCategory::class,
                'template' => 'blog/admin-category/manage-blog-category',
            ]
        ))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'form'     => AddBlogCategory::class,
            'model'    => BlogCategory::class,
            'redirect' => _url('admin.blog.category'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminAddEntryProcess([
            'key'      => 'category_id',
            'form'     => EditBlogCategory::class,
            'model'    => BlogCategory::class,
            'redirect' => _url('admin.blog.category'),
        ]))->process();
    }
}