<?php

namespace Neutron\User\Controller;


use Neutron\User\Form\AccountSettings;
use Phpfox\Mvc\MvcController;
use Phpfox\View\ViewModel;

class SettingsController extends MvcController
{
    public function actionIndex()
    {
        $form = new AccountSettings([]);

        return new ViewModel('user.settings.index', [
            'form' => $form,
        ]);
    }
}