<?php

namespace Neutron\Core\Controller;


use Phpfox\Action\ActionController;

class AdminController extends ActionController
{
    protected function initialize()
    {
        _get('auth');

        _get('layouts')->setThemeId('admin');

        _get('require_js')
            ->deps('package/core/admin');

        // todo verify logged in user can access admincp.
        if (!_pass(null, 'is_admin')) {
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