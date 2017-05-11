<?php
namespace Neutron\Core\Form\Admin\LogAdapter;

use Phpfox\Form\Form;

class EditLogAdapter extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Log Adapter','core.admin_log'));
        $this->setInfo(_text('[Edit Log Adapter Info]','core.admin_log'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `adapter_id` #identity
        
        // element `container_id`
        $this->addElement(array (
          'name' => 'container_id',
          'factory' => 'text',
          'label' => _text('Container Id','core.admin_log'),
          'note' => _text('[Container Id Note]', 'core.admin_log'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        
        // element `adapter_name`
        $this->addElement(array (
          'name' => 'adapter_name',
          'factory' => 'text',
          'label' => _text('Adapter Name','core.admin_log'),
          'note' => _text('[Adapter Name Note]', 'core.admin_log'),
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
          'label' => _text('Driver Id','core.admin_log'),
          'note' => _text('[Driver Id Note]', 'core.admin_log'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
          'required' => true,
        ));
        // skip element `params` #skips
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description','core.admin_log'),
          'note' => _text('[Description Note]', 'core.admin_log'),
          'attributes' => 
          array (
            'maxlength' => 255,
            'class' => 'form-control',
          ),
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
