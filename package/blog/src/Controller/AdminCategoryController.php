<?php

namespace Neutron\Blog\Controller;


use Neutron\Blog\Form\AddBlogCategory;
use Neutron\Blog\Model\BlogCategory;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminCategoryController extends AdminController
{
    public function initialized()
    {
        _service('html.title')
            ->clear()
            ->add(_text('Blogs'));

        _service('breadcrumb')
            ->clear()
            ->add(['href' => _url('admin.blog', ['action' => 'index']), 'label' => _text('Blogs')])
            ->add(['href' => _url('admin.blog.category', ['action' => 'index']), 'label' => _text('Categories')]);

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

        $items = _model('blog_category')
            ->select()
            ->all();

        return new ViewModel(['items' => $items,], 'blog/admin-category/index');

    }

    public function actionAdd()
    {
        $request = _service('request');

        $form = new AddBlogCategory();

        if ($request->isGet()) {

        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $blogCategory = new BlogCategory($data);
            $blogCategory->save();
        }

        return new ViewModel([
            'heading' => _text('Add Category'),
            'form'    => $form,
        ], 'layout/form-edit');
    }

    public function actionEdit()
    {
        $request = _service('request');
        $id = $request->get('id');

        /** @var BlogCategory $obj */
        $obj = _model('blog_category')->findById($id);

        $form = new AddBlogCategory();

        $form->getValidator()
            ->setParam('name', 'unique', 'accept', $id);

        if ($request->isGet()) {
            $form->populate($obj);
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $obj->fromArray($data);
            $obj->save();
        }

        return new ViewModel([
            'heading' => _text('Add Category'),
            'form'    => $form,
        ], 'layout/form-edit');
    }
}