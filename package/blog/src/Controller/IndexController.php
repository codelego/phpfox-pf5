<?php

namespace Neutron\Blog\Controller;

use Neutron\Blog\Form\AddBlogPost;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel([], 'blog/index/index');
    }

    public function actionAdd()
    {
        $form = new AddBlogPost();

        return new ViewModel([
            'form'    => $form,
            'heading' => _text('Add New Post'),
        ], 'layout/form-edit');
    }
}