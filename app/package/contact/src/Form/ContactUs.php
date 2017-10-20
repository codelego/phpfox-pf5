<?php

namespace Neutron\Contact\Form;

use Phpfox\Form\Form;

class ContactUs extends Form
{
    protected function initialize()
    {
        $contactService = \Phpfox::get('contact_us');
        $this->addElements([
            [
                'name'     => 'department_id',
                'factory'  => 'choice',
                'label'    => _text('Department', 'contact-form'),
                'required' => true,
                'render'   => 'radio',
                'value'    => $contactService->getDefaultDepartmentId(),
                'options'  => $contactService->getActiveDepartmentOptions(),
            ],
            [
                'name'     => 'name',
                'factory'  => 'text',
                'required' => true,
                'label'    => _text('Name', 'contact-form'),
            ],
            [
                'name'     => 'email',
                'factory'  => 'text',
                'required' => true,
                'label'    => _text('Email', 'contact-form'),
            ],
            [
                'name'     => 'subject',
                'factory'  => 'text',
                'required' => true,
                'label'    => _text('Subject', 'contact-form'),
            ],
            [
                'name'     => 'message',
                'factory'  => 'textarea',
                'required' => true,
                'label'    => _text('Message', 'contact-form'),
            ],
        ]);
    }

}