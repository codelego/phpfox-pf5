<?php
namespace Neutron\Core\Controller;

use Phpfox\Mvc\MvcController;

class AdminLoginController extends MvcController
{
    public function actionIndex()
    {
        \Phpfox::get('assets')
            ->addStyle('admin.login', null);

        \Phpfox::get('view.layout')
            ->setTemplate('layout.master.admin-login');
    }
}