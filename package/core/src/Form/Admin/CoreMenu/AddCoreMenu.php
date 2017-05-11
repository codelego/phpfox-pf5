<?php
namespace Neutron\Core\Form\Admin\CoreMenu;

use Phpfox\Form\Form;

class AddCoreMenu extends Form{

    public function initialize(){

        $this->setTitle(_text('Add Core Menu',''));
        $this->setInfo(_text('[Add Core Menu Info]',''));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `id` #identity
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order',null),
          'note' => _text('[Sort Order Note]', null),
          'value' => '100',
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `menu`
        $this->addElement(array (
          'name' => 'menu',
          'factory' => 'text',
          'label' => _text('Menu',null),
          'note' => _text('[Menu Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `name`
        $this->addElement(array (
          'name' => 'name',
          'factory' => 'text',
          'label' => _text('Name',null),
          'note' => _text('[Name Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `parent_name`
        $this->addElement(array (
          'name' => 'parent_name',
          'factory' => 'text',
          'label' => _text('Parent Name',null),
          'note' => _text('[Parent Name Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `package_id`
        $this->addElement(array (
          'name' => 'package_id',
          'factory' => 'select',
          'label' => _text('Package Id',null),
          'note' => _text('[Package Id Note]', null),
          'options' => _service('core.packages')->getPackageIdOptions(),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `label`
        $this->addElement(array (
          'name' => 'label',
          'factory' => 'text',
          'label' => _text('Label',null),
          'note' => _text('[Label Note]', null),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `route`
        $this->addElement(array (
          'name' => 'route',
          'factory' => 'text',
          'label' => _text('Route',null),
          'note' => _text('[Route Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        // skip element `params` #skips
        
        // element `extra`
        $this->addElement(array (
          'name' => 'extra',
          'factory' => 'text',
          'label' => _text('Extra',null),
          'note' => _text('[Extra Note]', null),
          'value' => '[]',
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `acl`
        $this->addElement(array (
          'name' => 'acl',
          'factory' => 'text',
          'label' => _text('Acl',null),
          'note' => _text('[Acl Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `event`
        $this->addElement(array (
          'name' => 'event',
          'factory' => 'text',
          'label' => _text('Event',null),
          'note' => _text('[Event Note]', null),
          'maxlength' => 255,
          'required' => false,
        ));
        
        // element `plugin`
        $this->addElement(array (
          'name' => 'plugin',
          'factory' => 'text',
          'label' => _text('Plugin',null),
          'note' => _text('[Plugin Note]', null),
          'maxlength' => 255,
          'required' => false,
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
        
        // element `is_custom`
        $this->addElement(array (
          'name' => 'is_custom',
          'factory' => 'yesno',
          'label' => _text('Is Custom',null),
          'note' => _text('[Is Custom Note]', null),
          'value' => '0',
          'required' => true,
        ));
        
        // element `type`
        $this->addElement(array (
          'name' => 'type',
          'factory' => 'text',
          'label' => _text('Type',null),
          'note' => _text('[Type Note]', null),
          'value' => 'route',
          'maxlength' => 255,
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
