<?php

namespace Neutron\User\Controller;

use Neutron\User\Form\ResetPasswordForm;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ResetPasswordController extends ActionController
{
    public function actionIndex()
    {

    }

    public function actionSendMail()
    {
        $form = new ResetPasswordForm([

        ]);

        return new ViewModel([
            'form' => $form,
        ], 'layout/form-edit');
    }

    public function actionReset()
    {

    }

    protected function passPrivateMode()
    {
        return true;
    }
}