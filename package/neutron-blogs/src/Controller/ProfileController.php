<?php

namespace Neutron\Blog\Controller;


use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        exit('blog.profile');
        return new ViewModel('blog.profile.index');
    }
}