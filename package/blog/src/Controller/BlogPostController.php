<?php

namespace Neutron\Blog\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class BlogPostController extends ActionController
{
    public function actionView()
    {
        $request = _service('request');
        $id = $request->get('id');

        $entry = _with('blog_post')->findById($id);

        return new ViewModel(['item' => $entry,], 'blog/post/view');
    }
}