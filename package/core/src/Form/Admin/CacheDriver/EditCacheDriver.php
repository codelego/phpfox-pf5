<?php
namespace Neutron\Core\Form\Admin\CacheDriver;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditCacheDriver extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Cache Driver','admin.core_cache'));
        $this->setInfo(_text('[Edit Cache Driver Info]','admin.core_cache'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `driver_id`
        $this->addElement(array (
          'name' => 'driver_id',
          'factory' => 'text',
          'label' => _text('Driver Id','admin.core_cache'),
          'note' => _text('[Driver Id Note]', 'admin.core_cache'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `driver_name`
        $this->addElement(array (
          'name' => 'driver_name',
          'factory' => 'text',
          'label' => _text('Driver Name','admin.core_cache'),
          'note' => _text('[Driver Name Note]', 'admin.core_cache'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `form_name`
        $this->addElement(array (
          'name' => 'form_name',
          'factory' => 'text',
          'label' => _text('Form Name','admin.core_cache'),
          'note' => _text('[Form Name Note]', 'admin.core_cache'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description','admin.core_cache'),
          'note' => _text('[Description Note]', 'admin.core_cache'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active','admin.core_cache'),
          'note' => _text('[Is Active Note]', 'admin.core_cache'),
          'value' => '1',
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
