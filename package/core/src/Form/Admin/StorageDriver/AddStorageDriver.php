<?php
namespace Neutron\Core\Form\Admin\StorageDriver;

use Phpfox\Form\Form;

class AddStorageDriver extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Storage Driver','admin.core_layout'));
        $this->setInfo(_text('[Add Storage Driver Info]','admin.core_layout'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `driver_id`
        $this->addElement(array (
          'name' => 'driver_id',
          'factory' => 'text',
          'label' => _text('Driver Id',null),
          'note' => _text('[Driver Id Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `driver_name`
        $this->addElement(array (
          'name' => 'driver_name',
          'factory' => 'text',
          'label' => _text('Driver Name',null),
          'note' => _text('[Driver Name Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `form_name`
        $this->addElement(array (
          'name' => 'form_name',
          'factory' => 'text',
          'label' => _text('Form Name',null),
          'note' => _text('[Form Name Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description',null),
          'note' => _text('[Description Note]', null),
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
        
        // element `driver_class`
        $this->addElement(array (
          'name' => 'driver_class',
          'factory' => 'text',
          'label' => _text('Driver Class',null),
          'note' => _text('[Driver Class Note]', null),
          'maxlength' => 255,
          'required' => false,
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
