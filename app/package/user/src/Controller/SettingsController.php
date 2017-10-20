<?php

namespace Neutron\User\Controller;


use Neutron\User\Form\AccountSettings;
use Phpfox\Kernel\ActionController;
use Phpfox\View\ViewModel;

class SettingsController extends ActionController
{
    public function actionIndex()
    {
        $form = new AccountSettings([]);

        return new ViewModel([
            'form' => $form,
        ], 'user/settings/index');
    }

    public function actionLoginHistory()
    {
        $userId = \Phpfox::get('auth')->getLoginId();


        $items = \Phpfox::get('user.auth_history')
            ->getByUserId($userId);

        return new ViewModel([
            'items' => $items,
        ], 'user/settings/login-history');

    }

    public function actionSubscriptions()
    {

    }
}