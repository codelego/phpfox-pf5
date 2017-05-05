<?php

namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;

class AdminAuthController extends ActionController
{

    public function actionLogin()
    {
        _service('auth');

        _service('layouts')->setThemeId('admin');

        _service('require_js')
            ->deps('package/core/admin');

        _service('template')
            ->preferThemes(['admin']);

        _service('assets')
            ->addStyle('admin.login', null);

        $layout = _service('layouts');

        $layout->setTemplate('layout/login');

        $request = _service('request');

        if ($request->isPost()) {
            $email = $request->get('email');
            $password = $request->get('password');

            $result = _service('auth')
                ->authenticate(null, $email, $password, []);

            if ($result->isValid()) {
                $user = _find('user', $result->getIdentity());
                _service('auth')->login($user, true);

                _redirect('admin');

            } else {
                $layout->assign([
                    'message' => $result->getMessage(),
                ]);
            }
        }
    }
}