<?php

namespace Neutron\ContactUs\Controller;

use Neutron\ContactUs\Form\ContactUs;
use Phpfox\Action\ActionController;
use Phpfox\View\ViewModel;

class ContactUsController extends ActionController
{
    public function actionIndex()
    {
        $form = new ContactUs();

        $vm = new ViewModel();

        $vm->setTemplate('contact-us.index.index');

        $vm->assign([
            'form'    => $form,
            'heading' => _text('Contact Us'),
        ]);

        return $vm;
    }
}