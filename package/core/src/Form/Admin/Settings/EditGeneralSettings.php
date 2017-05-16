<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditGeneralSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit General Settings', '_core.general_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', 'admin'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__offline` **/
            $this->addElement(array ( 'name' => 'core__offline', 'factory' => 'radio', 'label' => _text('Offline Mode','_core.general_settings'), 'value' => 'online', 'options' => _get('core.setting')->getSiteModeIdOptions(), 'required' => true, ));        
        
            /** element `core__private_site` **/
            $this->addElement(array ( 'name' => 'core__private_site', 'factory' => 'radio', 'label' => _text('Private Site','_core.general_settings'), 'info' => _text('[Private Site Info]', '_core.general_settings'), 'options' => _get('core.setting')->getPrivateSiteIdOptions(), 'required' => true, ));        
        
            /** element `core__access_key` **/
            $this->addElement(array ( 'name' => 'core__access_key', 'factory' => 'text', 'label' => _text('Access Key','_core.general_settings'), 'info' => _text('[Access Key Info]', '_core.general_settings'), 'value' => '9cafc', 'maxlength' => '5', 'required' => true, ));        
        
            /** element `core__ajax_mode` **/
            $this->addElement(array ( 'name' => 'core__ajax_mode', 'factory' => 'radio', 'label' => _text('Ajax Mode','_core.general_settings'), 'info' => _text('[Ajax Mode Info]', '_core.general_settings'), 'options' => _get('core.setting')->getAjaxModeIdOptions(), 'required' => true, ));        
        
            /** element `core__force_https` **/
            $this->addElement(array ( 'name' => 'core__force_https', 'factory' => 'yesno', 'label' => _text('Force to Https','_core.general_settings'), 'info' => _text('[Force Https Info]', '_core.general_settings'), 'required' => true, ));        
        
            /** element `core__secure_img` **/
            $this->addElement(array ( 'name' => 'core__secure_img', 'factory' => 'yesno', 'label' => _text('Secure Image','_core.general_settings'), 'info' => _text('[Secure Img Info]', '_core.general_settings'), 'required' => true, ));        
        
            /** element `core__bundle_js` **/
            $this->addElement(array ( 'name' => 'core__bundle_js', 'factory' => 'yesno', 'label' => _text('Use Bundle JS','_core.general_settings'), 'info' => _text('[Bundle Js Info]', '_core.general_settings'), 'required' => true, ));        
        
            /** element `core__bundle_css` **/
            $this->addElement(array ( 'name' => 'core__bundle_css', 'factory' => 'yesno', 'label' => _text('Use Bundle CSS','_core.general_settings'), 'info' => _text('[Bundle Css Info]', '_core.general_settings'), 'required' => true, ));        
        
            /** element `core__google_api_key` **/
            $this->addElement(array ( 'name' => 'core__google_api_key', 'factory' => 'text', 'label' => _text('Google Api Key','_core.general_settings'), 'info' => _text('[Google Api Key Info]', '_core.general_settings'), ));        
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
