<?php

namespace Neutron\Core\Controller;

use Phpfox\Kernel\ActionController;

class AdminAuthController extends ActionController
{

    public function actionLogin()
    {
        \Phpfox::get('auth');

        \Phpfox::get('layouts')->setThemeId('admin');

        \Phpfox::get('require_js')
            ->deps('package/core/admin');

        \Phpfox::get('template')
            ->preferThemes(['admin']);

        \Phpfox::get('assets')
            ->addStyle('admin.login', null);

        \Phpfox::get('layouts')
            ->setTemplate('layout/login');

        $request = \Phpfox::get('request');

        if ($request->isPost() and !empty($_POST['is_login'])) {
            $email = $request->get('email');
            $password = $request->get('password');

            $result = \Phpfox::get('auth')
                ->authenticate(null, $email, $password, []);

            if ($result->isValid()) {
                $user = \Phpfox::find('user', $result->getIdentity());
                \Phpfox::get('auth')->login($user, true);

                \Phpfox::redirect('admin');

            } else {
                \Phpfox::get('layouts')->assign([
                    'message' => $result->getMessage(),
                ]);
            }
        }
    }

    public function actionLogout()
    {
        \Phpfox::get('auth')->logout();
        \Phpfox::redirect('admin');
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