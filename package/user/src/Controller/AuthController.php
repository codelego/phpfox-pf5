<?php

namespace Neutron\User\Controller;

use Neutron\User\Form\UserLogin;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AuthController extends ActionController
{
    /**
     * @return ViewModel
     */
    public function actionLogin()
    {
        // start session
        $auth = _get('auth');


        if ($auth->isLoggedIn()) {
            // redirect to logged in user
            $user = $auth->getUser();
            _get('response')->redirect($user->getUrl(), 302);
        }

        $request = _get('request');
        $form = new UserLogin([]);
        $message = null;

        if ($request->isPost() and $form->isValid($request->all())) {
            $data = $form->getData();
            $result = $auth->authenticate('password', $data['username'],
                $data['password'], null);

            if ($result->isValid()) {
                $user = _find('user', $result->getIdentity());
                $auth->login($user, !!$data['remember']);

                $url = _url('home');

                _get('response')->redirect($url);
            } else {
                $form->addError('', $result->getMessage());
            }
        }


        return new ViewModel([
            'form' => $form,
        ], 'user/auth/login');
    }

    /**
     * @return ViewModel
     */
    public function actionLogout()
    {
        _get('auth')->logout();

        _get('response')->redirect(_url('home'));

        return new ViewModel([], 'user/auth/logout');
    }
}