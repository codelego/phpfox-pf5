<?php

namespace Neutron\Blog\Controller;


use Neutron\Blog\Form\Admin\BlogCategory\AddBlogCategory;
use Neutron\Blog\Form\Admin\BlogCategory\EditBlogCategory;
use Neutron\Blog\Model\BlogCategory;
use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;

class AdminCategoryController extends AdminController
{
    protected function afterInitialize()
    {
        _get('html.title')
            ->set(_text('Blogs'));

        _get('breadcrumb')
            ->set(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        _get('menu.admin.buttons')->load('_blog.buttons');
        _get('menu.admin.secondary')->load('admin', 'blog');

    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            _get('menu.admin.buttons')->load('_blog.category.buttons');
        }

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'filter.form' => null,
                'model'       => BlogCategory::class,
                'template'    => 'blog/admin-category/manage-blog-category',
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