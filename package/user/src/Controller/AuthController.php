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
        $auth = _service('auth');


        if ($auth->isLoggedIn()) {
            // redirect to logged in user
            $user = $auth->getUser();
            _redirect($user->getUrl(), 302);
        }

        $request = _service('request');
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

                _redirect($url);
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
        _service('auth')->logout();

        _redirect('home');

        return new ViewModel([], 'user/auth/logout');
    }
}