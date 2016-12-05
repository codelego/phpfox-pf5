<?php

namespace Neutron\User\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class AuthController extends MvcController
{
    public function actionLogin()
    {
        return new ViewModel('user.auth.login');
    }

    public function actionLogout()
    {
        return new ViewModel('user.auth.logout');
    }
}