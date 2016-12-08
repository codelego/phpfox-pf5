<?php

namespace Neutron\User\Controller;

use Neutron\User\Form\UserLogin;
use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class AuthController extends MvcController
{
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
            $form->bind($request->getParams());
            $data = $form->getData();


            $result = $auth->authenticate('password', $data['username'],
                $data['password'], null);

            if ($result->isSuccess()) {
                $user = \Phpfox::findById('user', $result->getIdentity());
                $auth->login($user, true, !!$data['remember']);
            } else {
                $message = $result->getMessage();
            }
        }

        return new ViewModel('user.auth.login',
            ['form' => $form, 'message' => $message]);
    }

    public function actionLogout()
    {
        return new ViewModel('user.auth.logout');
    }
}