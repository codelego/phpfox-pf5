<?php

namespace Neutron\User\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class RegisterController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel([], 'user/register/index');
    }
}