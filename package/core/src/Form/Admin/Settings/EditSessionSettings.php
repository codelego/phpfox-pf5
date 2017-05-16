<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSessionSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Core Session', '_core.session_settings'));
        $this->setInfo(_text('[Edit Core Session Info]', '_core.session_settings'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__default_session_id` **/
            $this->addElement(array ( 'name' => 'core__default_session_id', 'factory' => 'select', 'label' => _text('Default Session','_core.session_settings'), 'info' => _text('[Default Session Id Info]', '_core.session_settings'), 'options' => _get('core.adapter')->getAdapterIdOptions('session'), 'required' => true, ));        
        
            /** element `core__session_name` **/
            $this->addElement(array ( 'name' => 'core__session_name', 'factory' => 'text', 'label' => _text('Session Name','_core.session_settings'), 'info' => _text('[Session Name Info]', '_core.session_settings'), 'maxlength' => '16', 'required' => true, ));        
        
            /** element `core__cookie_domain` **/
            $this->addElement(array ( 'name' => 'core__cookie_domain', 'factory' => 'text', 'label' => _text('Cookie Domain','_core.session_settings'), 'note' => _text('[experience_only]', '_core'), 'info' => _text('[Cookie Domain Info]', '_core.session_settings'), ));        
        
            /** element `core__cookie_path` **/
            $this->addElement(array ( 'name' => 'core__cookie_path', 'factory' => 'text', 'label' => _text('Cookie Path','_core.session_settings'), 'note' => _text('[experience_only]', '_core'), 'info' => _text('[Cookie Path Info]', '_core.session_settings'), 'value' => '/', 'required' => true, ));        
        
            /** element `core__cookie_secure` **/
            $this->addElement(array ( 'name' => 'core__cookie_secure', 'factory' => 'yesno', 'label' => _text('Cookie Secure','_core.session_settings'), 'note' => _text('[experience_only]', '_core'), 'info' => _text('[Cookie Secure Info]', '_core.session_settings'), 'required' => true, ));        
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
