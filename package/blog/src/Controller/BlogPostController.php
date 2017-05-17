<?php

namespace Neutron\Blog\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class BlogPostController extends ActionController
{
    public function actionView()
    {

        $request = _get('request');
        $id = $request->get('id');

        $entry = _model('blog_post')->findById($id);

        return new ViewModel(['item' => $entry,], 'blog/post/view');
    }
}