<?php
namespace Neutron\Core\Form\Admin\StorageAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditStorageAdapter extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Storage Adapter',''));
        $this->setInfo(_text('[Edit Storage Adapter Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `adapter_id` #identity
        
        // element `adapter_name`
        $this->addElement(array (
          'name' => 'adapter_name',
          'factory' => 'text',
          'label' => _text('Adapter Name',null),
          'note' => _text('[Adapter Name Note]', null),
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
          'label' => _text('Driver Id',null),
          'note' => _text('[Driver Id Note]', null),
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
          'label' => _text('Is Active',null),
          'note' => _text('[Is Active Note]', null),
          'value' => '0',
          'required' => true,
        ));
        
        // element `is_required`
        $this->addElement(array (
          'name' => 'is_required',
          'factory' => 'yesno',
          'label' => _text('Is Required',null),
          'note' => _text('[Is Required Note]', null),
          'value' => '0',
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description',null),
          'note' => _text('[Description Note]', null),
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
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]),
        ];
        /** end buttons **/
    }
}
