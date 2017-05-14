<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditVerifySettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Core Verify', 'admin.core_verify_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__default_verify_id` **/
            $this->addElement(array ( 'name' => 'core__default_verify_id', 'factory' => 'select', 'label' => _text('Default Verify','admin.core_verify_setting'), 'info' => _text('[Default Verify Id Info]', 'admin.core_verify_setting'), ));        
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
