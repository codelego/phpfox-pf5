<?php

namespace Neutron\Blog\Controller;

use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class BlogPostController extends ActionController
{
    public function actionView()
    {

        $request = \Phpfox::get('request');
        $id = $request->get('id');

        $entry = \Phpfox::model('blog_post')->findById($id);

        return new ViewModel(['item' => $entry,], 'blog/post/view');
    }
}