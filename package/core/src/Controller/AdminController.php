<?php

namespace Neutron\Core\Controller;


use Phpfox\Support\ActionController;

class AdminController extends ActionController
{
    protected function initialize()
    {
        _get('auth');

        _get('layouts')->setThemeId('admin');

        _get('require_js')
            ->deps('package/core/admin');

        if (false == _allow(null, 'is_admin', false)) {
            $this->forward('core.admin-auth', 'login');
        }
    }

    protected function passOfflineMode()
    {
        return true;
    }

    protected function passPrivateMode()
    {
        return true;
    }

}