<?php
namespace Neutron\Core\Form\Admin\StorageAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterStorageAdapter extends Form{

    public function initialize(){

        $this->setMethod('get');

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'q',
            'label' => _text('Search', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => _text('Search', 'admin'),
            ],
        ]);
        
        /** start elements **/

                // skip element `adapter_id` #identity
        
        // element `adapter_name`
        $this->addElement(array (
          'name' => 'adapter_name',
          'factory' => 'text',
          'label' => _text('Adapter Name',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        
        // element `driver_id`
        $this->addElement(array (
          'name' => 'driver_id',
          'factory' => 'text',
          'label' => _text('Driver',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));
        // skip element `params` #skips
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'select',
          'label' => _text('Is Active',null),
          'options' => 
          array (
            0 => 
            array (
              'value' => 1,
              'label' => 'Yes',
            ),
            1 => 
            array (
              'value' => 0,
              'label' => 'No',
            ),
          ),
          'attributes' => 
          array (
            'class' => 'form-control',
          ),
        ));
        
        // element `is_required`
        $this->addElement(array (
          'name' => 'is_required',
          'factory' => 'select',
          'label' => _text('Is Required',null),
          'options' => 
          array (
            0 => 
            array (
              'value' => 1,
              'label' => 'Yes',
            ),
            1 => 
            array (
              'value' => 0,
              'label' => 'No',
            ),
          ),
          'attributes' => 
          array (
            'class' => 'form-control',
          ),
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'text',
          'label' => _text('Description',null),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
        ));

        /** end elements **/
    }

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'search',
                'label'      => _text('Search'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ])
        ];
        /** end buttons **/
    }
}
