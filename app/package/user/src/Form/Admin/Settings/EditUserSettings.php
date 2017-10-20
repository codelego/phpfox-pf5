<?php
namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditUserSettings extends Form {

    /** id=674 */
    public function initialize(){

        $this->setTitle(_text('Edit User Settings', '_user'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `user_register__mode` id=3537 **/
            $this->addElement(array ( 'name' => 'user_register__mode', 'factory' => 'radio', 'label' => _text('Registration Mode','_user'), 'placeholder' => _text('Registration Mode','_user'), 'info' => _text('Registration Mode [Info]', '_user'), 'value' => 'public', 'options' => \Phpfox::get('user.register')->getRegisterModeOptions(), 'required' => true, ));        
        
            /** element `user_register__require_verification` id=3541 **/
            $this->addElement(array ( 'name' => 'user_register__require_verification', 'factory' => 'yesno', 'label' => _text('Require Verification','_user'), 'placeholder' => _text('Require Verification','_user'), 'info' => _text('Require Verification [Info]', '_user'), 'value' => '0', 'required' => true, ));        
        
            /** element `user_register__verification_process` id=3540 **/
            $this->addElement(array ( 'name' => 'user_register__verification_process', 'factory' => 'multi_checkbox', 'label' => _text('Verification Process','_user'), 'placeholder' => _text('Verification Process','_user'), 'info' => _text('Verification Process [Info]', '_user'), 'options' => \Phpfox::get('user.register')->getVerificationOptions(), 'required' => true, ));        
        
            /** element `user_register__approval_process` id=3520 **/
            $this->addElement(array ( 'name' => 'user_register__approval_process', 'factory' => 'yesno', 'label' => _text('Approval Process','_user'), 'placeholder' => _text('Approval Process','_user'), 'info' => _text('Approve Process [Info]', '_user'), 'value' => '0', 'required' => true, ));        
        
            /** element `user_register__auto_login` id=3521 **/
            $this->addElement(array ( 'name' => 'user_register__auto_login', 'factory' => 'yesno', 'label' => _text('Auto Login','_user'), 'placeholder' => _text('Auto Login','_user'), 'info' => _text('Auto Login [Info]', '_user'), 'value' => '1', 'required' => true, ));        
        
            /** element `user_register__notify_admin` id=3522 **/
            $this->addElement(array ( 'name' => 'user_register__notify_admin', 'factory' => 'yesno', 'label' => _text('Notify Admin','_user'), 'placeholder' => _text('Notify Admin','_user'), 'info' => _text('Notify Admin [Info]', '_user'), 'value' => '0', 'required' => true, ));        
        
            /** element `user_register__send_welcome_email` id=3523 **/
            $this->addElement(array ( 'name' => 'user_register__send_welcome_email', 'factory' => 'yesno', 'label' => _text('Send Welcome Email','_user'), 'placeholder' => _text('Send Welcome Email','_user'), 'info' => _text('Send Welcome Email [Info]', '_user'), 'value' => '1', 'required' => true, ));        
        
            /** element `user_register__successful_url` id=3526 **/
            $this->addElement(array ( 'name' => 'user_register__successful_url', 'factory' => 'text', 'label' => _text('Successful Url','_user'), 'placeholder' => _text('Successful Url','_user'), 'info' => _text('Successful Url [Info]', '_user'), 'value' => '/', 'required' => true, ));        
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
            'href'       => _url('admin.user'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
