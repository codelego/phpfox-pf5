<?php
namespace Neutron\Core\Controller;

use Phpfox\Action\ActionController;

class AdminAuthController extends ActionController
{
    public function actionLogin()
    {
        \Phpfox::get('view.template')
            ->preferThemes(['admin']);

        \Phpfox::get('assets')
            ->addStyle('admin.login', null);


        $layout = \Phpfox::get('view.layout');

        $layout->setTemplate('layout.login');

        $request = \Phpfox::get('mvc.request');

        if ($request->isPost()) {
            $email = $request->get('email');
            $password = $request->get('password');

            $result = \Phpfox::get('auth')
                ->authenticate(null, $email, $password, []);

            if ($result->isValid()) {
                $user = \Phpfox::findById('user', $result->getIdentity());
                \Phpfox::get('auth')->login($user, true);

                \Phpfox::get('mvc.response')->redirect(_url('admin'));

            } else {
                $layout->assign([
                    'message' => $result->getMessage(),
                ]);
            }
        }
    }
}