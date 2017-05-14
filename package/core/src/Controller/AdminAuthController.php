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

        _get('layouts')
            ->setTemplate('layout/login');

        $request = _get('request');

        if ($request->isPost()) {
            $email = $request->get('email');
            $password = $request->get('password');

            $result = _get('auth')
                ->authenticate(null, $email, $password, []);

            if ($result->isValid()) {
                $user = _find('user', $result->getIdentity());
                _get('auth')->login($user, true);

                _redirect('admin');

            } else {
                _get('layouts')->assign([
                    'message' => $result->getMessage(),
                ]);
            }
        }
    }
}