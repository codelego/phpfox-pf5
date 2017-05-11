<?php
namespace Neutron\Core\Form\Admin\LayoutComponent;

use Phpfox\Form\Form;

class FilterLayoutComponent extends Form{

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

                
        // element `component_id`
        $this->addElement(array (
          'name' => 'component_id',
          'factory' => 'text',
          'label' => _text('Component',null),
          'maxlength' => 255,
        ));
        
        // element `component_name`
        $this->addElement(array (
          'name' => 'component_name',
          'factory' => 'text',
          'label' => _text('Component Name',null),
          'maxlength' => 255,
        ));
        
        // element `component_class`
        $this->addElement(array (
          'name' => 'component_class',
          'factory' => 'text',
          'label' => _text('Component Class',null),
          'maxlength' => 255,
        ));
        
        // element `form_name`
        $this->addElement(array (
          'name' => 'form_name',
          'factory' => 'text',
          'label' => _text('Form Name',null),
          'maxlength' => 255,
        ));
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package',null),
          'options' => _service('core.packages')->getPackageIdOptions(),
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
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'text',
          'label' => _text('Description',null),
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
