<?php

namespace Neutron\Blog\Controller;

use Neutron\Blog\Form\AddBlogPost;
use Neutron\Blog\Form\Admin\BlogPost\DeleteBlogPost;
use Neutron\Blog\Form\Admin\BlogPost\EditBlogPost;
use Neutron\Blog\Form\Admin\BlogPost\FilterBlogPost;
use Neutron\Blog\Model\BlogPost;
use Neutron\Core\Controller\AdminController;
use Neutron\Core\Process\AdminAddEntryProcess;
use Neutron\Core\Process\AdminListEntryProcess;
use Phpfox\View\ViewModel;

class AdminPostController extends AdminController
{
    protected function afterInitialize()
    {
        \Phpfox::get('html.title')
            ->set(_text('Blogs'));

        \Phpfox::get('breadcrumb')
            ->set(['href' => _url('admin.blog'), 'label' => _text('Blogs')]);

        \Phpfox::get('menu.admin.buttons')->load('_blog.buttons');
        \Phpfox::get('menu.admin.secondary')->load('admin', 'blog');
    }

    protected function afterDispatch($action)
    {
        if (in_array($action, ['index'])) {
            \Phpfox::get('menu.admin.buttons')->load('_blog.post.buttons');
        }

    }

    public function actionIndex()
    {
        return (new AdminListEntryProcess([
                'model'       => BlogPost::class,
                'filter.form' => FilterBlogPost::class,
                'template'    => 'blog/admin/manage-post',
            ]
        ))->process();

    }

    public function actionDelete()
    {
        $request = \Phpfox::get('request');
        $identity = $request->get('post_id');

        $entry = \Phpfox::find('blog_post', $identity);

        $form = new DeleteBlogPost();

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $entry->delete();
        }
        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
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