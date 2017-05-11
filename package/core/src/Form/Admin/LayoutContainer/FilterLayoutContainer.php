<?php
namespace Neutron\Core\Form\Admin\LayoutContainer;

use Phpfox\Form\Form;

class FilterLayoutContainer extends Form{

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

                // skip element `container_id` #identity
        
        // element `page_id`
        $this->addElement(array (
          'name' => 'page_id',
          'factory' => 'text',
          'label' => _text('Page',null),
          'maxlength' => 255,
        ));
        
        // element `grid_id`
        $this->addElement(array (
          'name' => 'grid_id',
          'factory' => 'text',
          'label' => _text('Grid',null),
          'maxlength' => 255,
        ));
        
        // element `type_id`
        $this->addElement(array (
          'name' => 'type_id',
          'factory' => 'text',
          'label' => _text('Type',null),
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
        // skip element `params` #skips

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        /** end elements **/
    }
}
