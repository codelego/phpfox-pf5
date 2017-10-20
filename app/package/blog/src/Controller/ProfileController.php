<?php

namespace Neutron\Blog\Controller;


use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        $viewModel = new ViewModel();

        $viewModel->setTemplate('blog/profile/index');

        return $viewModel;
    }
}