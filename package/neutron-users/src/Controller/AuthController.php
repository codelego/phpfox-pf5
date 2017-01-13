<?php

namespace Neutron\User\Controller;

use Neutron\User\Form\UserLogin;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class AuthController extends ActionController
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
            $form->populate($request->getParams());
            $data = $form->getData();


            $result = $auth->authenticate('password', $data['username'],
                $data['password'], null);

            if ($result->isValid()) {
                $user = \Phpfox::findById('user', $result->getIdentity());
                $auth->login($user, !!$data['remember']);
            } else {
                $message = $result->getMessage();
            }
        }

        $vm = new ViewModel(['form' => $form, 'message' => $message]);

        $vm->setTemplate('user.auth.login');

        return $vm;
    }

    public function actionLogout()
    {
        \Phpfox::get('auth')->logout();

        $vm = new ViewModel();

        $vm->setTemplate('user.auth.logout');

        return $vm;
    }
}