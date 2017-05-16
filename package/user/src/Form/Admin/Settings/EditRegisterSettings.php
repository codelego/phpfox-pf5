<?php
namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditRegisterSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit User Register', '_user.register'));
        $this->setInfo(_text('[Edit User Register Info]', '_user.register'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `user_register__show_dob` **/
            $this->addElement(array ( 'name' => 'user_register__show_dob', 'factory' => 'text', 'label' => _text('Show Dob','_user.register'), 'info' => _text('[Show Dob Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_gender` **/
            $this->addElement(array ( 'name' => 'user_register__show_gender', 'factory' => 'text', 'label' => _text('Show Gender','_user.register'), 'info' => _text('[Show Gender Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_displayname` **/
            $this->addElement(array ( 'name' => 'user_register__show_displayname', 'factory' => 'text', 'label' => _text('Show Displayname','_user.register'), 'info' => _text('[Show Displayname Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_locale` **/
            $this->addElement(array ( 'name' => 'user_register__show_locale', 'factory' => 'text', 'label' => _text('Show Locale','_user.register'), 'info' => _text('[Show Locale Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_location` **/
            $this->addElement(array ( 'name' => 'user_register__show_location', 'factory' => 'text', 'label' => _text('Show Location','_user.register'), 'info' => _text('[Show Location Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_timezone` **/
            $this->addElement(array ( 'name' => 'user_register__show_timezone', 'factory' => 'text', 'label' => _text('Show Timezone','_user.register'), 'info' => _text('[Show Timezone Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_captcha` **/
            $this->addElement(array ( 'name' => 'user_register__show_captcha', 'factory' => 'text', 'label' => _text('Show Captcha','_user.register'), 'info' => _text('[Show Captcha Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_username` **/
            $this->addElement(array ( 'name' => 'user_register__show_username', 'factory' => 'text', 'label' => _text('Show Username','_user.register'), 'info' => _text('[Show Username Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_email` **/
            $this->addElement(array ( 'name' => 'user_register__show_email', 'factory' => 'text', 'label' => _text('Show Email','_user.register'), 'info' => _text('[Show Email Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_reenter_email` **/
            $this->addElement(array ( 'name' => 'user_register__show_reenter_email', 'factory' => 'text', 'label' => _text('Show Reenter Email','_user.register'), 'info' => _text('[Show Reenter Email Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_password` **/
            $this->addElement(array ( 'name' => 'user_register__show_password', 'factory' => 'text', 'label' => _text('Show Password','_user.register'), 'info' => _text('[Show Password Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_reenter_password` **/
            $this->addElement(array ( 'name' => 'user_register__show_reenter_password', 'factory' => 'text', 'label' => _text('Show Reenter Password','_user.register'), 'info' => _text('[Show Reenter Password Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_terms` **/
            $this->addElement(array ( 'name' => 'user_register__show_terms', 'factory' => 'text', 'label' => _text('Show Terms','_user.register'), 'info' => _text('[Show Terms Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_invite_code` **/
            $this->addElement(array ( 'name' => 'user_register__show_invite_code', 'factory' => 'text', 'label' => _text('Show Invite Code','_user.register'), 'info' => _text('[Show Invite Code Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_currency` **/
            $this->addElement(array ( 'name' => 'user_register__show_currency', 'factory' => 'text', 'label' => _text('Show Currency','_user.register'), 'info' => _text('[Show Currency Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__successful_url` **/
            $this->addElement(array ( 'name' => 'user_register__successful_url', 'factory' => 'text', 'label' => _text('Successful Url','_user.register'), 'info' => _text('[Successful Url Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__send_welcome_email` **/
            $this->addElement(array ( 'name' => 'user_register__send_welcome_email', 'factory' => 'text', 'label' => _text('Send Welcome Email','_user.register'), 'info' => _text('[Send Welcome Email Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__send_verify_email` **/
            $this->addElement(array ( 'name' => 'user_register__send_verify_email', 'factory' => 'text', 'label' => _text('Send Verify Email','_user.register'), 'info' => _text('[Send Verify Email Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__login_after_success` **/
            $this->addElement(array ( 'name' => 'user_register__login_after_success', 'factory' => 'text', 'label' => _text('Login After Success','_user.register'), 'info' => _text('[Login After Success Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__auto_login` **/
            $this->addElement(array ( 'name' => 'user_register__auto_login', 'factory' => 'text', 'label' => _text('Auto Login','_user.register'), 'info' => _text('[Auto Login Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__auto_approve` **/
            $this->addElement(array ( 'name' => 'user_register__auto_approve', 'factory' => 'text', 'label' => _text('Auto Approve','_user.register'), 'info' => _text('[Auto Approve Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__notify_admin` **/
            $this->addElement(array ( 'name' => 'user_register__notify_admin', 'factory' => 'text', 'label' => _text('Notify Admin','_user.register'), 'info' => _text('[Notify Admin Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__verify_email_timeout` **/
            $this->addElement(array ( 'name' => 'user_register__verify_email_timeout', 'factory' => 'text', 'label' => _text('Verify Email Timeout','_user.register'), 'info' => _text('[Verify Email Timeout Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_subscriptions` **/
            $this->addElement(array ( 'name' => 'user_register__show_subscriptions', 'factory' => 'text', 'label' => _text('Show Subscriptions','_user.register'), 'info' => _text('[Show Subscriptions Info]', '_user.register'), 'required' => true, ));        
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
