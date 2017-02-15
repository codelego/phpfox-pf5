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
        $auth = \Phpfox::get('auth');


        if ($auth->isLoggedIn()) {
            // redirect to logged in user
            $user = $auth->getUser();
            \Phpfox::get('mvc.response')->redirect($user->getUrl(), 302);
        }

        $request = \Phpfox::get('mvc.request');
        $form = new UserLogin([]);
        $message = null;

        if ($request->isPost()) {
            $form->populate($request->all());
            $data = $form->getData();

            $result = $auth->authenticate('password', $data['username'],
                $data['password'], null);

            if ($result->isValid()) {
                $user = \Phpfox::findById('user', $result->getIdentity());
                $auth->login($user, !!$data['remember']);

                $url = _url('home');

                \Phpfox::get('mvc.response')->redirect($url);
            } else {
                $message = $result->getMessage();
            }
        }


        return new ViewModel([
            'form'    => $form,
            'message' => $message,
        ], 'user/auth/login');
    }

    /**
     * @return ViewModel
     */
    public function actionLogout()
    {
        \Phpfox::get('auth')->logout();

        \Phpfox::get('mvc.response')->redirect(_url('home'));

        return new ViewModel([], 'user/auth/logout');
    }
}