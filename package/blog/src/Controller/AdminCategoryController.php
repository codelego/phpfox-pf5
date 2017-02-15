<?php

namespace Neutron\Blog\Controller;


use Neutron\Blog\Form\AddBlogCategory;
use Neutron\Blog\Model\BlogCategory;
use Neutron\Core\Controller\AdminController;
use Phpfox\View\ViewModel;

class AdminCategoryController extends AdminController
{
    public function actionAdd()
    {
        $request = \Phpfox::get('mvc.request');

        $form = new AddBlogCategory();

        if ($request->isGet()) {

        }

        if ($request->isPost()) {
            $form->populate($request->all());
            $data = $form->getData();

            $blogCategory = new BlogCategory($data);
            $blogCategory->save();
        }

        return new ViewModel([
            'heading' => _text('Add Category'),
            'form'    => $form,
        ], 'layout/admin-edit');
    }

    public function actionEdit()
    {
        $request = \Phpfox::get('mvc.request');
        $id = $request->get('id');

        /** @var BlogCategory $obj */
        $obj = \Phpfox::with('blog_category')->findById($id);

        $form = new AddBlogCategory();

        if ($request->isGet()) {
            $form->populate($obj);
        }

        if ($request->isPost()) {
            $form->populate($request->all());
            $data = $form->getData();

            $obj->fromArray($data);
            $obj->save();
        }

        return new ViewModel([
            'heading' => _text('Add Category'),
            'form'    => $form,
        ], 'layout/admin-edit');
    }

    public function actionIndex()
    {
        $items = \Phpfox::with('blog_category')
            ->select()
            ->all();

        return new ViewModel(['items' => $items,], 'blog/admin-category/index');

    }
}