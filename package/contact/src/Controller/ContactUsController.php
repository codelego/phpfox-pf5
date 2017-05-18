<?php

namespace Neutron\Contact\Controller;

use Neutron\Contact\Form\ContactUs;
use Phpfox\Support\ActionController;
use Phpfox\View\ViewModel;

class ContactUsController extends ActionController
{
    public function actionIndex()
    {
        $form = new ContactUs();

        return new ViewModel([
            'form'    => $form,
        ], 'contact/index/index');
    }
}