<?php
namespace Neutron\Core\Form\Admin\I18nTimezone;

use Phpfox\Form\Form;

class EditI18nTimezone extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Timezone','admin.i18n'));
        $this->setInfo(_text('[Edit Timezone Info]','admin.i18n'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `timezone_id`
        $this->addElement(array (
          'name' => 'timezone_id',
          'factory' => 'text',
          'label' => _text('Timezone Id',null),
          'note' => _text('[Timezone Id Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `timezone_location`
        $this->addElement(array (
          'name' => 'timezone_location',
          'factory' => 'text',
          'label' => _text('Timezone Location',null),
          'note' => _text('[Timezone Location Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active',null),
          'note' => _text('[Is Active Note]', null),
          'value' => '1',
          'required' => true,
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'note' => _text('[Sort Order Note]', null),
          'value' => '0',
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `timezone_code`
        $this->addElement(array (
          'name' => 'timezone_code',
          'factory' => 'text',
          'label' => _text('Timezone Code',null),
          'note' => _text('[Timezone Code Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `timezone_offset`
        $this->addElement(array (
          'name' => 'timezone_offset',
          'factory' => 'text',
          'label' => _text('Timezone Offset',null),
          'note' => _text('[Timezone Offset Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));

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
