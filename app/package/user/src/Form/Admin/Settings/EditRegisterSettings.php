<?php
namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditRegisterSettings extends Form {

    /** id=675 */
    public function initialize(){

        $this->setTitle(_text('Edit Registration Settings', '_user'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `user_register__show_displayname` id=2155 **/
            $this->addElement(array ( 'name' => 'user_register__show_displayname', 'factory' => 'yesno', 'label' => _text('Show Displayname','_user'), 'placeholder' => _text('Show Displayname','_user'), 'note' => _text('Show Displayname [Note]', '_user'), 'info' => _text('Show Displayname [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_username` id=2160 **/
            $this->addElement(array ( 'name' => 'user_register__show_username', 'factory' => 'yesno', 'label' => _text('Show Username','_user'), 'placeholder' => _text('Show Username','_user'), 'note' => _text('Show Username [Note]', '_user'), 'info' => _text('Show Username [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_email` id=2161 **/
            $this->addElement(array ( 'name' => 'user_register__show_email', 'factory' => 'yesno', 'label' => _text('Show Email','_user'), 'placeholder' => _text('Show Email','_user'), 'note' => _text('Show Email [Note]', '_user'), 'info' => _text('Show Email [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_reenter_email` id=2162 **/
            $this->addElement(array ( 'name' => 'user_register__show_reenter_email', 'factory' => 'yesno', 'label' => _text('Show Reenter Email','_user'), 'placeholder' => _text('Show Reenter Email','_user'), 'info' => _text('Show Reenter Email [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_password` id=2163 **/
            $this->addElement(array ( 'name' => 'user_register__show_password', 'factory' => 'yesno', 'label' => _text('Show Password','_user'), 'placeholder' => _text('Show Password','_user'), 'note' => _text('Show Password [Note]', '_user'), 'info' => _text('Show Password [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_reenter_password` id=2164 **/
            $this->addElement(array ( 'name' => 'user_register__show_reenter_password', 'factory' => 'yesno', 'label' => _text('Show Reenter Password','_user'), 'placeholder' => _text('Show Reenter Password','_user'), 'info' => _text('Show Reenter Password [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_gender` id=2154 **/
            $this->addElement(array ( 'name' => 'user_register__show_gender', 'factory' => 'yesno', 'label' => _text('Show Gender','_user'), 'placeholder' => _text('Show Gender','_user'), 'note' => _text('Show Gender [Note]', '_user'), 'info' => _text('Show Gender [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_dob` id=2153 **/
            $this->addElement(array ( 'name' => 'user_register__show_dob', 'factory' => 'yesno', 'label' => _text('Show Dob','_user'), 'placeholder' => _text('Show Dob','_user'), 'info' => _text('Show Dob [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_locale` id=2156 **/
            $this->addElement(array ( 'name' => 'user_register__show_locale', 'factory' => 'yesno', 'label' => _text('Show Locale','_user'), 'placeholder' => _text('Show Locale','_user'), 'info' => _text('Show Locale [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_currency` id=2167 **/
            $this->addElement(array ( 'name' => 'user_register__show_currency', 'factory' => 'yesno', 'label' => _text('Show Currency','_user'), 'placeholder' => _text('Show Currency','_user'), 'info' => _text('Show Currency [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_location` id=2157 **/
            $this->addElement(array ( 'name' => 'user_register__show_location', 'factory' => 'yesno', 'label' => _text('Show Location','_user'), 'placeholder' => _text('Show Location','_user'), 'info' => _text('Show Location [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_timezone` id=2158 **/
            $this->addElement(array ( 'name' => 'user_register__show_timezone', 'factory' => 'yesno', 'label' => _text('Show Timezone','_user'), 'placeholder' => _text('Show Timezone','_user'), 'info' => _text('Show Timezone [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_captcha` id=2159 **/
            $this->addElement(array ( 'name' => 'user_register__show_captcha', 'factory' => 'yesno', 'label' => _text('Show Captcha','_user'), 'placeholder' => _text('Show Captcha','_user'), 'info' => _text('Show Captcha [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_terms` id=2165 **/
            $this->addElement(array ( 'name' => 'user_register__show_terms', 'factory' => 'yesno', 'label' => _text('Show Terms','_user'), 'placeholder' => _text('Show Terms','_user'), 'info' => _text('Show Terms [Info]', '_user'), 'required' => true, ));        
        
            /** element `user_register__show_invite_code` id=2166 **/
            $this->addElement(array ( 'name' => 'user_register__show_invite_code', 'factory' => 'yesno', 'label' => _text('Show Invite Code','_user'), 'placeholder' => _text('Show Invite Code','_user'), 'info' => _text('Show Invite Code [Info]', '_user'), 'required' => true, ));        
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
