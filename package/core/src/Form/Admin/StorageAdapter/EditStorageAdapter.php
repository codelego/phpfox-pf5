<?php
namespace Neutron\Core\Form\Admin\StorageAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditStorageAdapter extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Storage Adapter','admin.core_layout'));
        $this->setInfo(_text('[Edit Storage Adapter Info]','admin.core_layout'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `adapter_id` #identity
        
        // element `adapter_name`
        $this->addElement(array (
          'name' => 'adapter_name',
          'factory' => 'text',
          'label' => _text('Adapter Name','admin.core_layout'),
          'note' => _text('[Adapter Name Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `driver_id`
        $this->addElement(array (
          'name' => 'driver_id',
          'factory' => 'text',
          'label' => _text('Driver Id','admin.core_layout'),
          'note' => _text('[Driver Id Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `params` #skips
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active','admin.core_layout'),
          'note' => _text('[Is Active Note]', 'admin.core_layout'),
          'value' => '0',
          'required' => true,
        ));
        // skip element `is_default` #skips
        
        // element `is_fallback`
        $this->addElement(array (
          'name' => 'is_fallback',
          'factory' => 'yesno',
          'label' => _text('Is Fallback','admin.core_layout'),
          'note' => _text('[Is Fallback Note]', 'admin.core_layout'),
          'value' => '0',
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description','admin.core_layout'),
          'note' => _text('[Description Note]', 'admin.core_layout'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd'=>'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
