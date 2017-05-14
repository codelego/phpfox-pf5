<?php
namespace Neutron\Dev\Form\Admin\DevTable;

use Phpfox\Form\Form;

class EditDevTable extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Dev Table',''));
        $this->setInfo(_text('[Edit Dev Table Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `table_name` **/
            $this->addElement(array ( 'name' => 'table_name', 'factory' => 'text', 'label' => _text('Table Name',null), 'info' => _text('[Table Name Info]', null), 'required' => '1', ));        
        
            /** element `package_id` **/
            $this->addElement(array ( 'name' => 'package_id', 'factory' => 'select', 'label' => _text('Package Id',null), 'info' => _text('[Package Id Info]', null), 'value' => 'undefined', 'options' => _service('core.packages')->getPackageIdOptions(), 'required' => '1', ));        
        
            /** element `action_id` **/
            $this->addElement(array ( 'name' => 'action_id', 'factory' => 'text', 'label' => _text('Action Id',null), 'info' => _text('[Action Id Info]', null), 'value' => 'default', 'required' => '1', ));        
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
