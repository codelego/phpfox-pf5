<?php
namespace Neutron\Core\Form\Admin\LogDriver;

use Phpfox\Form\Form;

class EditLogDriver extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Log Driver','core.admin_log'));
        $this->setInfo(_text('[Edit Log Driver Info]','core.admin_log'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        
        // element `driver_id`
        $this->addElement(array (
          'name' => 'driver_id',
          'factory' => 'text',
          'label' => _text('Driver Id','core.admin_log'),
          'note' => _text('[Driver Id Note]', 'core.admin_log'),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `driver_name`
        $this->addElement(array (
          'name' => 'driver_name',
          'factory' => 'text',
          'label' => _text('Driver Name','core.admin_log'),
          'note' => _text('[Driver Name Note]', 'core.admin_log'),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `form_name`
        $this->addElement(array (
          'name' => 'form_name',
          'factory' => 'text',
          'label' => _text('Form Name','core.admin_log'),
          'note' => _text('[Form Name Note]', 'core.admin_log'),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description','core.admin_log'),
          'note' => _text('[Description Note]', 'core.admin_log'),
          'maxlength' => 255,
          'required' => true,
        ));
        
        // element `is_active`
        $this->addElement(array (
          'name' => 'is_active',
          'factory' => 'yesno',
          'label' => _text('Is Active','core.admin_log'),
          'note' => _text('[Is Active Note]', 'core.admin_log'),
          'value' => '1',
          'required' => true,
        ));
        
        // element `sort_order`
        $this->addElement(array (
          'name' => 'sort_order',
          'factory' => 'text',
          'label' => _text('Sort Order','core.admin_log'),
          'note' => _text('[Sort Order Note]', 'core.admin_log'),
          'value' => '1',
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
