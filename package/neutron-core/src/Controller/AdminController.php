<?php
namespace Neutron\Core\Controller;


use Phpfox\Action\ActionController;

class AdminController extends ActionController
{
    protected function initialize()
    {
        $login = \Phpfox::get('auth')->getLogin();

        // todo verify logged in user can access admincp.
        if (!$login) {
            $this->forward('core.admin-auth', 'login');
        }
    }
}