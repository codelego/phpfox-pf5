<?php

namespace Neutron\Core\Controller;


use Phpfox\Action\ActionController;

class AdminController extends ActionController
{
    protected function initialize()
    {
        _service('auth');

        _service('layouts')->setThemeId('admin');

        _service('require_js')
            ->deps('package/core/admin');

        // todo verify logged in user can access admincp.
        if (!_pass('is_admin')) {
            $this->forward('core.admin-auth', 'login');
        }
    }
}