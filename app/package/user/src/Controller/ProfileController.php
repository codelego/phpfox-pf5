<?php

namespace Neutron\User\Controller;

use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        $vm = new ViewModel();

        $vm->setTemplate('user/profile/index');

        return $vm;
    }
}