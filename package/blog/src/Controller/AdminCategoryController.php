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
        $request = _get('request');

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
        $request = _get('request');
        $id = $request->get('id');

        /** @var BlogCategory $obj */
        $obj = _with('blog_category')->findById($id);

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

    public function actionIndex()
    {
        $items = _with('blog_category')
            ->select()
            ->all();

        return new ViewModel(['items' => $items,], 'blog/admin-category/index');

    }
}