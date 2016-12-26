<?php

namespace Neutron\User\Controller;

use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ProfileController extends ActionController
{
    public function actionIndex()
    {
        exit('user.profile');
        return new ViewModel('user.profile.index');
    }
}