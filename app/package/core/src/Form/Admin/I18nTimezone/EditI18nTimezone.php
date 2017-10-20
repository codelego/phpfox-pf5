<?php
namespace Neutron\Core\Form\Admin\I18nTimezone;

use Phpfox\Form\Form;

class EditI18nTimezone extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Timezone',''));
        $this->setInfo(_text('[Edit Timezone Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `timezone_id` **/
            $this->addElement(array ( 'name' => 'timezone_id', 'factory' => 'text', 'label' => _text('Timezone Id',null), 'info' => _text('[Timezone Id Info]', null), 'required' => '1', ));        
        
            /** element `timezone_location` **/
            $this->addElement(array ( 'name' => 'timezone_location', 'factory' => 'text', 'label' => _text('Timezone Location',null), 'info' => _text('[Timezone Location Info]', null), 'required' => '1', ));        
        
            /** element `is_active` **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'info' => _text('[Is Active Info]', null), 'value' => '1', 'required' => '1', ));        
        
            /** element `ordering` **/
            $this->addElement(array ( 'name' => 'ordering', 'factory' => 'text', 'label' => _text('Ordering',null), 'info' => _text('[Ordering Info]', null), 'value' => '0', 'required' => '1', ));
        
            /** element `timezone_code` **/
            $this->addElement(array ( 'name' => 'timezone_code', 'factory' => 'text', 'label' => _text('Timezone Code',null), 'info' => _text('[Timezone Code Info]', null), 'required' => '1', ));        
        
            /** element `timezone_offset` **/
            $this->addElement(array ( 'name' => 'timezone_offset', 'factory' => 'text', 'label' => _text('Timezone Offset',null), 'info' => _text('[Timezone Offset Info]', null), 'required' => '1', ));        
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
