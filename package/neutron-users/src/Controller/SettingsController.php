<?php

namespace Neutron\User\Controller;


use Neutron\User\Form\AccountSettings;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class SettingsController extends ActionController
{
    public function actionIndex()
    {
        $form = new AccountSettings([]);

        return new ViewModel('user.settings.index', [
            'form' => $form,
        ]);
    }
}