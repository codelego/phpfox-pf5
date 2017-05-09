<?php

namespace Neutron\Blog\Controller;

use Neutron\Blog\Form\AddBlogPost;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        $items = _model('blog_post')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'blog/index/index');
    }

    public function actionAdd()
    {
        $form = new AddBlogPost();

        $request = _service('request');

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $entry = _model('blog_post')->create($data);
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
        ], 'layout/form-edit');
    }
}