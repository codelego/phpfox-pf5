<?php
namespace Neutron\Core\Form\Admin\MailAdapter;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditMailAdapter extends Form{

    public function initialize(){

        $this->setTitle(_text('Edit Mail Adapter','admin.core_mail'));
        $this->setInfo(_text('[Edit Mail Adapter Info]','admin.core_mail'));
        $this->setAction(_url('#'));
        
        /** start elements **/

        // skip element `adapter_id` #identity
        
        // element `adapter_name`
        $this->addElement(array (
          'name' => 'adapter_name',
          'factory' => 'text',
          'label' => _text('Adapter Name','admin.core_mail'),
          'note' => _text('[Adapter Name Note]', 'admin.core_mail'),
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
          'label' => _text('Driver Id','admin.core_mail'),
          'note' => _text('[Driver Id Note]', 'admin.core_mail'),
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
          'label' => _text('Is Active','admin.core_mail'),
          'note' => _text('[Is Active Note]', 'admin.core_mail'),
          'value' => '0',
          'required' => true,
        ));
        // skip element `is_default` #skips
        
        // element `is_fallback`
        $this->addElement(array (
          'name' => 'is_fallback',
          'factory' => 'yesno',
          'label' => _text('Is Fallback','admin.core_mail'),
          'note' => _text('[Is Fallback Note]', 'admin.core_mail'),
          'value' => '0',
          'required' => true,
        ));
        
        // element `description`
        $this->addElement(array (
          'name' => 'description',
          'factory' => 'textarea',
          'label' => _text('Description','admin.core_mail'),
          'note' => _text('[Description Note]', 'admin.core_mail'),
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
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
