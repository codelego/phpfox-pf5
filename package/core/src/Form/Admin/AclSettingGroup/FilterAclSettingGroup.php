<?php
namespace Neutron\Core\Form\Admin\AclSettingGroup;

use Phpfox\Form\Form;

class FilterAclSettingGroup extends Form{

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

                
        // element `group_id`
        $this->addElement(array (
          'name' => 'group_id',
          'factory' => 'text',
          'label' => _text('Group',null),
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
        
        // element `title`
        $this->addElement(array (
          'name' => 'title',
          'factory' => 'text',
          'label' => _text('Title',null),
          'maxlength' => 255,
        ));
        
        // element `form_name`
        $this->addElement(array (
          'name' => 'form_name',
          'factory' => 'text',
          'label' => _text('Form Name',null),
          'maxlength' => 255,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'text',
          'label' => _text('Description',null),
          'maxlength' => 255,
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
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

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        /** end elements **/
    }
}