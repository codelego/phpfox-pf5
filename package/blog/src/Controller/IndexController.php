<?php

namespace Neutron\Blog\Controller;

use Neutron\Blog\Form\AddBlogPost;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        $items =  \Phpfox::with('blog_post')->select()->all();

        return new ViewModel([
            'items'=>$items,
        ], 'blog/index/index');
    }

    public function actionAdd()
    {
        $form = new AddBlogPost();

        $request =  \Phpfox::get('request');

        if($request->isPost() and $form->isValid($request->all())){
            $data = $form->getData();
            $entry  = \Phpfox::with('blog_post')->create($data);
            $entry->save();
        }

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Add New Post'),
        ], 'layout/form-edit');
    }
}