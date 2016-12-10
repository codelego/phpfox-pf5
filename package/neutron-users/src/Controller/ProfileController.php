<?php

namespace Neutron\User\Controller;

use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class ProfileController extends MvcController
{
    public function actionIndex()
    {
        exit('user.profile');
        return new ViewModel('user.profile.index');
    }
}