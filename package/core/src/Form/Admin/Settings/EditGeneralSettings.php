<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditGeneralSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Core General', 'admin.core_general_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__offline_code` **/
            $this->addElement(array ( 'name' => 'core__offline_code', 'factory' => 'text', 'label' => _text('Offline Code','admin.core_general_setting'), 'info' => _text('[Offline Code Info]', 'admin.core_general_setting'), ));        
        
            /** element `core__running_mode` **/
            $this->addElement(array ( 'name' => 'core__running_mode', 'factory' => 'text', 'label' => _text('Running Mode','admin.core_general_setting'), 'info' => _text('[Running Mode Info]', 'admin.core_general_setting'), ));        
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
