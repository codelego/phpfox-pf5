<?php

namespace Neutron\Contact\Controller;

use Neutron\Contact\Form\ContactUs;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ContactUsController extends ActionController
{
    public function actionIndex()
    {
        $form = new ContactUs();

        $vm = new ViewModel();

        $vm->setTemplate('contact/index/index');

        $vm->assign([
            'form'    => $form,
            'heading' => _text('Contact Us'),
        ]);

        return $vm;
    }
}