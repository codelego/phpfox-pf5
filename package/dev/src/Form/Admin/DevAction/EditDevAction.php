<?php
namespace Neutron\Dev\Form\Admin\DevAction;

use Phpfox\Form\Form;

class EditDevAction extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Dev Action','_dev.edit_action'));
        $this->setInfo(_text('[Edit Dev Action Info]','_dev.edit_action'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `form_title` **/
            $this->addElement(array ( 'name' => 'form_title', 'factory' => 'text', 'label' => _text('Form Title','_dev.edit_action'), ));        
        
            /** element `form_info` **/
            $this->addElement(array ( 'name' => 'form_info', 'factory' => 'text', 'label' => _text('Form Info','_dev.edit_action'), ));        
        
            /** element `text_domain` **/
            $this->addElement(array ( 'name' => 'text_domain', 'factory' => 'text', 'label' => _text('Text Domain','_dev.edit_action'), ));        
        
            /** element `data_submit` **/
            $this->addElement(array ( 'name' => 'data_submit', 'factory' => 'text', 'label' => _text('Data Submit','_dev.edit_action'), 'info' => _text('[Data Submit Info]', '_dev.edit_action'), ));        
        
            /** element `cancel_url` **/
            $this->addElement(array ( 'name' => 'cancel_url', 'factory' => 'text', 'label' => _text('Cancel Url','_dev.edit_action'), 'info' => _text('[Cancel Url Info]', '_dev.edit_action'), ));        
        
            /** element `action_url` **/
            $this->addElement(array ( 'name' => 'action_url', 'factory' => 'text', 'label' => _text('Action Url','_dev.edit_action'), 'info' => _text('[Action Url Info]', '_dev.edit_action'), ));        
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
