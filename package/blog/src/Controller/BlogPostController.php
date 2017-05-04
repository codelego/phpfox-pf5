<?php

namespace Neutron\Blog\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class BlogPostController extends ActionController
{
    public function actionView()
    {
        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $entry = \Phpfox::with('blog_post')->findById($id);

        return new ViewModel(['item' => $entry,], 'blog/post/view');
    }
}