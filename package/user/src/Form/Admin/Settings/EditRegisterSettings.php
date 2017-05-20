<?php
namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditRegisterSettings extends Form {

    /** id=675 */
    public function initialize(){

        $this->setTitle(_text('Edit Registration Settings', '_user.register'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `user_register__show_subscriptions` id=2182 **/
            $this->addElement(array ( 'name' => 'user_register__show_subscriptions', 'factory' => 'yesno', 'label' => _text('Show Subscriptions','_user.register'), 'info' => _text('Show Subscriptions [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_displayname` id=2155 **/
            $this->addElement(array ( 'name' => 'user_register__show_displayname', 'factory' => 'yesno', 'label' => _text('Show Displayname','_user.register'), 'note' => _text('Show Displayname [Note]', '_user.register'), 'info' => _text('Show Displayname [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_username` id=2160 **/
            $this->addElement(array ( 'name' => 'user_register__show_username', 'factory' => 'yesno', 'label' => _text('Show Username','_user.register'), 'note' => _text('Show Username [Note]', '_user.register'), 'info' => _text('Show Username [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_email` id=2161 **/
            $this->addElement(array ( 'name' => 'user_register__show_email', 'factory' => 'yesno', 'label' => _text('Show Email','_user.register'), 'note' => _text('Show Email [Note]', '_user.register'), 'info' => _text('Show Email [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_reenter_email` id=2162 **/
            $this->addElement(array ( 'name' => 'user_register__show_reenter_email', 'factory' => 'yesno', 'label' => _text('Show Reenter Email','_user.register'), 'info' => _text('Show Reenter Email [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_password` id=2163 **/
            $this->addElement(array ( 'name' => 'user_register__show_password', 'factory' => 'yesno', 'label' => _text('Show Password','_user.register'), 'note' => _text('Show Password [Note]', '_user.register'), 'info' => _text('Show Password [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_reenter_password` id=2164 **/
            $this->addElement(array ( 'name' => 'user_register__show_reenter_password', 'factory' => 'yesno', 'label' => _text('Show Reenter Password','_user.register'), 'info' => _text('Show Reenter Password [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_gender` id=2154 **/
            $this->addElement(array ( 'name' => 'user_register__show_gender', 'factory' => 'yesno', 'label' => _text('Show Gender','_user.register'), 'note' => _text('Show Gender [Note]', '_user.register'), 'info' => _text('Show Gender [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_dob` id=2153 **/
            $this->addElement(array ( 'name' => 'user_register__show_dob', 'factory' => 'yesno', 'label' => _text('Show Dob','_user.register'), 'info' => _text('Show Dob [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_locale` id=2156 **/
            $this->addElement(array ( 'name' => 'user_register__show_locale', 'factory' => 'yesno', 'label' => _text('Show Locale','_user.register'), 'info' => _text('Show Locale [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_currency` id=2167 **/
            $this->addElement(array ( 'name' => 'user_register__show_currency', 'factory' => 'yesno', 'label' => _text('Show Currency','_user.register'), 'info' => _text('Show Currency [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_location` id=2157 **/
            $this->addElement(array ( 'name' => 'user_register__show_location', 'factory' => 'yesno', 'label' => _text('Show Location','_user.register'), 'info' => _text('Show Location [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_timezone` id=2158 **/
            $this->addElement(array ( 'name' => 'user_register__show_timezone', 'factory' => 'yesno', 'label' => _text('Show Timezone','_user.register'), 'info' => _text('Show Timezone [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_captcha` id=2159 **/
            $this->addElement(array ( 'name' => 'user_register__show_captcha', 'factory' => 'yesno', 'label' => _text('Show Captcha','_user.register'), 'info' => _text('Show Captcha [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_terms` id=2165 **/
            $this->addElement(array ( 'name' => 'user_register__show_terms', 'factory' => 'yesno', 'label' => _text('Show Terms','_user.register'), 'info' => _text('Show Terms [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__show_invite_code` id=2166 **/
            $this->addElement(array ( 'name' => 'user_register__show_invite_code', 'factory' => 'yesno', 'label' => _text('Show Invite Code','_user.register'), 'info' => _text('Show Invite Code [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__auto_approve` id=2179 **/
            $this->addElement(array ( 'name' => 'user_register__auto_approve', 'factory' => 'yesno', 'label' => _text('Auto Approve','_user.register'), 'info' => _text('Auto Approve [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__auto_login` id=2178 **/
            $this->addElement(array ( 'name' => 'user_register__auto_login', 'factory' => 'yesno', 'label' => _text('Auto Login','_user.register'), 'info' => _text('Auto Login [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__notify_admin` id=2180 **/
            $this->addElement(array ( 'name' => 'user_register__notify_admin', 'factory' => 'yesno', 'label' => _text('Notify Admin','_user.register'), 'info' => _text('Notify Admin [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__send_welcome_email` id=2169 **/
            $this->addElement(array ( 'name' => 'user_register__send_welcome_email', 'factory' => 'yesno', 'label' => _text('Send Welcome Email','_user.register'), 'info' => _text('Send Welcome Email [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__send_verify_email` id=2170 **/
            $this->addElement(array ( 'name' => 'user_register__send_verify_email', 'factory' => 'yesno', 'label' => _text('Send Verify Email','_user.register'), 'info' => _text('Send Verify Email [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__verify_email_timeout` id=2181 **/
            $this->addElement(array ( 'name' => 'user_register__verify_email_timeout', 'factory' => 'text', 'label' => _text('Verify Email Timeout','_user.register'), 'info' => _text('Verify Email Timeout [Info]', '_user.register'), 'required' => true, ));        
        
            /** element `user_register__successful_url` id=2168 **/
            $this->addElement(array ( 'name' => 'user_register__successful_url', 'factory' => 'text', 'label' => _text('Successful Url','_user.register'), 'info' => _text('Successful Url [Info]', '_user.register'), 'required' => true, ));        
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
