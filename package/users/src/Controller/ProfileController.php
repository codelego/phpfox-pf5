<?php

namespace Neutron\User\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        $viewModel = new ViewModel();

        $viewModel->setTemplate('user/profile/index');

        return $viewModel;
    }
}