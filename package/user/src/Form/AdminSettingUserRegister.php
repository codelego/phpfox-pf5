<?php

namespace Neutron\User\Form;

use Neutron\Core\Form\FormSiteSettings;

class AdminSettingUserRegister extends FormSiteSettings
{
    protected function initialize()
    {
        $this->setTitle(_text('User Registration Settings', 'user_register'));
        $this->setInfo(_text('[Site Settings Note]', 'admin'));

        $this->addElement([
            'factory'  => 'radio',
            'name'     => 'user_register__register_mode',
            'value'    => 'public',
            'label'    => _text('Registration Mode', 'user_register'),
            'info'     => _text('[Registration Mode Note]', 'user_register'),
            'options'  => [
                ['value' => 'public', 'label' => 'Public, everyone can register a new account'],
                ['value' => 'admin_invite_only', 'label' => 'Admin Invite Only, everyone can register a new account'],
                ['value' => 'invite_only', 'label' => 'Invite Only, everyone can register a new account'],
                ['value' => 'disabled', 'label' => 'Disabled, Nobody can register a new account'],
            ],
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__choose_subscription',
            'value'    => 0,
            'label'    => _text('Choose Subscriptions', 'user_register'),
            'note'     => _text('[Choose Subscriptions Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_username',
            'value'    => 0,
            'label'    => _text('Display Username', 'user_register'),
            'note'     => _text('[Display Username Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_password',
            'value'    => 0,
            'label'    => _text('Display Password', 'user_register'),
            'note'     => _text('[Display Password Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_timezone',
            'value'    => 0,
            'label'    => _text('Display Timezone', 'user_register'),
            'note'     => _text('[Display Timezone Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_dob',
            'value'    => 0,
            'label'    => _text('Display Date of Birth', 'user_register'),
            'note'     => _text('[Display Date of Birth Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_location',
            'value'    => 0,
            'label'    => _text('Display Location', 'user_register'),
            'note'     => _text('[Display Location Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_gender',
            'value'    => 0,
            'label'    => _text('Display Gender', 'user_register'),
            'note'     => _text('[Display Gender Note]', 'user_register'),
            'required' => true,
        ]);


        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_term_of_use',
            'value'    => 0,
            'label'    => _text('Display Terms of Use', 'user_register'),
            'note'     => _text('[Display Terms of Use Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_reenter_email',
            'value'    => 0,
            'label'    => _text('Display Reenter Email', 'user_register'),
            'note'     => _text('[Display Reenter Email Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__display_reenter_password',
            'value'    => 0,
            'label'    => _text('Display Reenter Password', 'user_register'),
            'note'     => _text('[Display Reenter Password Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__notify_admin',
            'value'    => 0,
            'label'    => _text('Notify Admin', 'user_register'),
            'note'     => _text('[Notify Admin Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__verify_email',
            'value'    => 0,
            'label'    => _text('Verify Email', 'user_register'),
            'note'     => _text('[Verify Email Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'user_register__verify_email_timeout',
            'value'      => 0,
            'label'      => _text('Verify Email Timeout', 'user_register'),
            'note'       => _text('[Verify Email Timeout Note]', 'user_register'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'user_register__auto_friend_list',
            'value'      => '',
            'label'      => _text('Auto Make Friends', 'user_register'),
            'note'       => _text('[Auto Make Friends Note]', 'user_register'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__welcome_email',
            'value'    => 0,
            'label'    => _text('Welcome Email', 'user_register'),
            'note'     => _text('[Welcome Email Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__auto_approval',
            'value'    => 1,
            'label'    => _text('Auto Approval', 'user_register'),
            'note'     => _text('[Auto Approval Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'  => 'yesno',
            'name'     => 'user_register__auto_login',
            'value'    => 1,
            'label'    => _text('Auto Login', 'user_register'),
            'note'     => _text('[Auto Login Note]', 'user_register'),
            'required' => true,
        ]);

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'user_register__redirection_url',
            'value'      => '',
            'label'      => _text('Redirection URL', 'user_register'),
            'note'       => _text('[Redirection URL Note]', 'user_register'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);
    }
}