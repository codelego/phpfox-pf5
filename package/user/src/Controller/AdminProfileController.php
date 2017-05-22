<?php

namespace Neutron\User\Controller;

use Neutron\Core\Controller\AdminBasicProfileController;

class AdminProfileController extends AdminBasicProfileController
{
    protected function afterInitialize()
    {
        _get('menu.admin.secondary')->load('_user.profile');

        _get('menu.admin.buttons')->load('_user.buttons');
    }
}