<?php
namespace Neutron\Contact\Form\Admin\ContactDepartment;

use Phpfox\Form\Form;

class EditContactDepartment extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Contact Department',''));
        $this->setInfo(_text('[Edit Contact Department Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_default` **/
            $this->addElement(array ( 'name' => 'is_default', 'factory' => 'yesno', 'label' => _text('Is Default',null), 'info' => _text('[Is Default Info]', null), 'value' => '0', 'required' => '1', ));        
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
