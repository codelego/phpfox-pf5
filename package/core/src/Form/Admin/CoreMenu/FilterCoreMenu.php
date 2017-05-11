<?php
namespace Neutron\Core\Form\Admin\CoreMenu;

use Phpfox\Form\Form;

class FilterCoreMenu extends Form{

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

                // skip element `id` #identity
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'maxlength' => 255,
        ));
        
        // element `menu`
        $this->addElement(array (
          'name' => 'menu',
          'factory' => 'text',
          'label' => _text('Menu',null),
          'maxlength' => 255,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'maxlength' => 255,
        ));
        
        // element `parent_name`
        $this->addElement(array (
          'name' => 'parent_name',
          'factory' => 'text',
          'label' => _text('Parent Name',null),
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
        
        // element `label`
        $this->addElement(array (
          'name' => 'label',
          'factory' => 'text',
          'label' => _text('Label',null),
          'maxlength' => 255,
        ));
        
        // element `route`
        $this->addElement(array (
          'name' => 'route',
          'factory' => 'text',
          'label' => _text('Route',null),
          'maxlength' => 255,
        ));
        // skip element `params` #skips
        
        // element `extra`
        $this->addElement(array (
          'name' => 'extra',
          'factory' => 'text',
          'label' => _text('Extra',null),
          'maxlength' => 255,
        ));
        
        // element `acl`
        $this->addElement(array (
          'name' => 'acl',
          'factory' => 'text',
          'label' => _text('Acl',null),
          'maxlength' => 255,
        ));
        
        // element `event`
        $this->addElement(array (
          'name' => 'event',
          'factory' => 'text',
          'label' => _text('Event',null),
          'maxlength' => 255,
        ));
        
        // element `plugin`
        $this->addElement(array (
          'name' => 'plugin',
          'factory' => 'text',
          'label' => _text('Plugin',null),
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
        
        // element `is_custom`
        $this->addElement(array (
          'name' => 'is_custom',
          'factory' => 'select',
          'label' => _text('Is Custom',null),
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
        
        // element `type`
        $this->addElement(array (
          'name' => 'type',
          'factory' => 'text',
          'label' => _text('Type',null),
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
