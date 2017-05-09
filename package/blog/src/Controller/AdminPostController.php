<?php

namespace Neutron\Blog\Controller;

use Neutron\Blog\Form\AddBlogPost;
use Neutron\Blog\Form\Admin\BlogPost\EditBlogPost;
use Neutron\Blog\Model\BlogPost;
use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminManageEntryProcess;

class AdminPostController extends AdminController
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
            _service('menu.admin.buttons')->load('admin.blog.post.buttons');
        }

    }

    public function actionIndex()
    {
        return (new AdminManageEntryProcess([
                'model'    => BlogPost::class,
                'template' => 'blog/admin-post/manage-blog-post',
            ]
        ))->process();

    }

    public function actionAdd()
    {
        return (new AdminAddEntryProcess([
            'form'     => AddBlogPost::class,
            'model'    => BlogPost::class,
            'redirect' => _url('admin.blog.category'),
        ]))->process();
    }

    public function actionEdit()
    {
        return (new AdminAddEntryProcess([
            'key'      => 'category_id',
            'form'     => EditBlogPost::class,
            'model'    => BlogPost::class,
            'redirect' => _url('admin.blog.category'),
        ]))->process();
    }
}