<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;

class AdminAuthController extends ActionController
{

    public function actionLogin()
    {
        _get('auth');

        _get('layouts')->setThemeId('admin');

        _get('require_js')
            ->deps('package/core/admin');

        _get('template')
            ->preferThemes(['admin']);

        _get('assets')
            ->addStyle('admin.login', null);

        $layout = _get('layouts');

        $layout->setTemplate('layout/login');

        $request = _get('request');

        if ($request->isPost()) {
            $email = $request->get('email');
            $password = $request->get('password');

            $result = _get('auth')
                ->authenticate(null, $email, $password, []);

            if ($result->isValid()) {
                $user = \Phpfox::findById('user', $result->getIdentity());
                _get('auth')->login($user, true);

                _get('response')->redirect(_url('admin'));

            } else {
                $layout->assign([
                    'message' => $result->getMessage(),
                ]);
            }
        }
    }
}