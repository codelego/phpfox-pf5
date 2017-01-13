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

        $vm = new ViewModel([
            'form' => $form,
        ]);
        $vm->setTemplate('user.settings.index');

        return $vm;
    }
}