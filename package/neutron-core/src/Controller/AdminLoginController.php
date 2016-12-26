<?php
namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;

class AdminLoginController extends ActionController
{
    public function actionIndex()
    {
        \Phpfox::get('assets')
            ->addStyle('admin.login', null);

        \Phpfox::get('view.layout')
            ->setTemplate('layout.master.admin-login');
    }
}