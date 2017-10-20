<?php

namespace Neutron\Core\Controller;


use Phpfox\Kernel\ActionController;

class AdminController extends ActionController
{
    protected function initialize()
    {
        \Phpfox::get('auth');

        \Phpfox::get('layouts')->setThemeId('admin');

        \Phpfox::get('require_js')
            ->deps('package/core/admin');

        if (false == \Phpfox::allow(null, 'is_admin', false)) {
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