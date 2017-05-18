<?php

namespace Neutron\User\Controller;

use Phpfox\Support\ActionController;
use Phpfox\View\ViewModel;

class RegisterController extends ActionController
{
    public function actionIndex()
    {
        return new ViewModel([], 'user/register/index');
    }

    protected function passPrivateMode()
    {
        return true;
    }
}