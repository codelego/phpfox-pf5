<?php

namespace Neutron\User\Controller;

use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class RegisterController extends ActionController
{
    public function actionIndex()
    {
        _get('html.title')
            ->set('Create New Account');

        return new ViewModel([], 'user/register/index');
    }

    protected function passPrivateMode()
    {
        return true;
    }
}