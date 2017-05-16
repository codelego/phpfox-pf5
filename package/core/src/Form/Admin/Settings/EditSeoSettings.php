<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSeoSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Seo Settings', '_core.seo_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', 'admin'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__site_title` **/
            $this->addElement(array ( 'name' => 'core__site_title', 'factory' => 'text', 'label' => _text('Site Title','_core.seo_settings'), 'info' => _text('[Site Title Info]', '_core.seo_settings'), 'required' => true, ));        
        
            /** element `core__title_separator` **/
            $this->addElement(array ( 'name' => 'core__title_separator', 'factory' => 'text', 'label' => _text('Title Separator','_core.seo_settings'), 'info' => _text('[Title Separator Info]', '_core.seo_settings'), 'value' => '&#187;', 'required' => true, ));        
        
            /** element `core__site_description` **/
            $this->addElement(array ( 'name' => 'core__site_description', 'factory' => 'textarea', 'label' => _text('Site Description','_core.seo_settings'), 'info' => _text('[Site Description Info]', '_core.seo_settings'), 'rows' => '3', ));        
        
            /** element `core__description_limit` **/
            $this->addElement(array ( 'name' => 'core__description_limit', 'factory' => 'text', 'label' => _text('Description Limit','_core.seo_settings'), 'info' => _text('[Description Limit Info]', '_core.seo_settings'), 'required' => true, ));        
        
            /** element `core__site_keyword` **/
            $this->addElement(array ( 'name' => 'core__site_keyword', 'factory' => 'textarea', 'label' => _text('Site Keyword','_core.seo_settings'), 'info' => _text('[Site Keyword Info]', '_core.seo_settings'), 'rows' => '3', ));        
        
            /** element `core__keyword_limit` **/
            $this->addElement(array ( 'name' => 'core__keyword_limit', 'factory' => 'text', 'label' => _text('Keyword Limit','_core.seo_settings'), 'info' => _text('[Keyword Limit Info]', '_core.seo_settings'), 'required' => true, ));        
        
            /** element `core__enable_facebook` **/
            $this->addElement(array ( 'name' => 'core__enable_facebook', 'factory' => 'yesno', 'label' => _text('Enable Facebook','_core.seo_settings'), 'info' => _text('[Enable Facebook Info]', '_core.seo_settings'), 'required' => true, ));        
        
            /** element `core__facebook_app_id` **/
            $this->addElement(array ( 'name' => 'core__facebook_app_id', 'factory' => 'text', 'label' => _text('Facebook App','_core.seo_settings'), 'info' => _text('[Facebook App Id Info]', '_core.seo_settings'), ));        
        
            /** element `core__facebook_app_secret` **/
            $this->addElement(array ( 'name' => 'core__facebook_app_secret', 'factory' => 'text', 'label' => _text('Facebook App Secret','_core.seo_settings'), 'info' => _text('[Facebook App Secret Info]', '_core.seo_settings'), ));        
        
            /** element `core__facebook_app_name` **/
            $this->addElement(array ( 'name' => 'core__facebook_app_name', 'factory' => 'text', 'label' => _text('Facebook App Name','_core.seo_settings'), 'info' => _text('[Facebook App Name Info]', '_core.seo_settings'), ));        
        
            /** element `core__enable_google_plus` **/
            $this->addElement(array ( 'name' => 'core__enable_google_plus', 'factory' => 'yesno', 'label' => _text('Enable Google Plus','_core.seo_settings'), 'info' => _text('[Enable Google Plus Info]', '_core.seo_settings'), 'required' => true, ));        
        
            /** element `core__google_plus_id` **/
            $this->addElement(array ( 'name' => 'core__google_plus_id', 'factory' => 'select', 'label' => _text('Google Plus ID','_core.seo_settings'), 'info' => _text('[Google Plus Id Info]', '_core.seo_settings'), ));        
        
            /** element `core__enable_google_analytic` **/
            $this->addElement(array ( 'name' => 'core__enable_google_analytic', 'factory' => 'yesno', 'label' => _text('Enable Google Analytic','_core.seo_settings'), 'info' => _text('[Enable Google Analytic Info]', '_core.seo_settings'), 'required' => true, ));        
        
            /** element `core__google_analytic_id` **/
            $this->addElement(array ( 'name' => 'core__google_analytic_id', 'factory' => 'text', 'label' => _text('Google Analytic ID','_core.seo_settings'), 'info' => _text('[Google Analytic Id Info]', '_core.seo_settings'), ));        
        
            /** element `core__enable_open_graph` **/
            $this->addElement(array ( 'name' => 'core__enable_open_graph', 'factory' => 'yesno', 'label' => _text('Enable Open Graph','_core.seo_settings'), 'info' => _text('[Enable Open Graph Info]', '_core.seo_settings'), 'required' => true, ));        
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
