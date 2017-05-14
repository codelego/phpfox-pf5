<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditMessageSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Core Message', 'admin.core_message_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/

        
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
