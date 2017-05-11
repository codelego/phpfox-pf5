<?php
namespace Neutron\Core\Form\Admin\I18nTimezone;

use Phpfox\Form\Form;

class FilterI18nTimezone extends Form{

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

                
        // element `timezone_id`
        $this->addElement(array (
          'name' => 'timezone_id',
          'factory' => 'text',
          'label' => _text('Timezone',null),
          'maxlength' => 255,
        ));
        
        // element `timezone_location`
        $this->addElement(array (
          'name' => 'timezone_location',
          'factory' => 'text',
          'label' => _text('Timezone Location',null),
          'maxlength' => 255,
        ));
        
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
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'maxlength' => 255,
        ));
        
        // element `timezone_code`
        $this->addElement(array (
          'name' => 'timezone_code',
          'factory' => 'text',
          'label' => _text('Timezone Code',null),
          'maxlength' => 255,
        ));
        
        // element `timezone_offset`
        $this->addElement(array (
          'name' => 'timezone_offset',
          'factory' => 'text',
          'label' => _text('Timezone Offset',null),
          'maxlength' => 255,
        ));

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        /** end elements **/
    }
}
