<?php

namespace Neutron\Blog\Controller;

use Neutron\Blog\Form\AddBlogPost;
use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class IndexController extends ActionController
{
    public function actionIndex()
    {
        $items = \Phpfox::model('blog_post')->select()->all();

        return new ViewModel([
            'items' => $items,
        ], 'blog/index/index');
    }

    public function actionAdd()
    {
        $form = new AddBlogPost();

        $request = \Phpfox::get('request');

        $userId = \Phpfox::get('auth')->getLoginId();

        $quota = \Phpfox::allow(null, 'blog.post_limit', 10);

        $total = \Phpfox::model('blog_post')
            ->select()
            ->where('user_id=?', $userId)
            ->count();

        if ($total > $quota) {
            exit('reach limit quota');
        }

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $entry = \Phpfox::model('blog_post')->create($data);
            $entry->save();
        }

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }
}