<?php

namespace Neutron\Blog\Controller;


use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class ProfileController extends MvcController
{
    public function actionIndex()
    {
        exit('blog.profile');
        return new ViewModel('blog.profile.index');
    }
}