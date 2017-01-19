<?php
namespace Neutron\Core\Controller;


use Phpfox\Action\ActionController;

class AdminController extends ActionController
{
    protected function initialize()
    {
        \Phpfox::get('auth');

        \Phpfox::get('view.template')
            ->preferThemes(['admin']);

        // todo verify logged in user can access admincp.
        if (!_pass('is_admin')) {
            $this->forward('core.admin-auth', 'login');
        }
    }
}