<?php
namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;

class AdminAuthController extends ActionController
{
    public function actionLogin()
    {
        \Phpfox::get('template')
            ->preferThemes(['admin']);

        \Phpfox::get('assets')
            ->addStyle('admin.login', null);

        $layout = \Phpfox::get('layouts');

        $layout->setTemplate('layout/login');

        $request = \Phpfox::get('request');

        if ($request->isPost()) {
            $email = $request->get('email');
            $password = $request->get('password');

            $result = \Phpfox::get('auth')
                ->authenticate(null, $email, $password, []);

            if ($result->isValid()) {
                $user = \Phpfox::findById('user', $result->getIdentity());
                \Phpfox::get('auth')->login($user, true);

                \Phpfox::get('response')->redirect(_url('admin'));

            } else {
                $layout->assign([
                    'message' => $result->getMessage(),
                ]);
            }
        }
    }
}