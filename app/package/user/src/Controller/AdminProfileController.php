<?php

namespace Neutron\User\Controller;

use Neutron\Core\Controller\AdminBasicProfileController;

class AdminProfileController extends AdminBasicProfileController
{
    protected function afterInitialize()
    {
        \Phpfox::get('menu.admin.secondary')->load('_user.profile');

        \Phpfox::get('menu.admin.buttons')->load('_user.buttons');
    }
}