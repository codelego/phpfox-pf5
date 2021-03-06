<?php
namespace Neutron\Core\Form\Admin\ProfileAttribute;

use Phpfox\Form\Form;

class EditProfileAttribute extends Form {

    /** id=741 */
    public function initialize(){

        $this->setTitle(_text('Edit Profile Attribute',''));
        $this->setInfo(_text('[Edit Profile Attribute Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `item_type` id=2567 **/
            $this->addElement(array ( 'name' => 'item_type', 'factory' => 'text', 'label' => _text('Item Type',null), 'placeholder' => _text('Item Type',null), 'info' => _text('Item Type [Info]', null), 'required' => true, ));        
        
            /** element `attribute_name` id=2568 **/
            $this->addElement(array ( 'name' => 'attribute_name', 'factory' => 'text', 'label' => _text('Attribute Name',null), 'placeholder' => _text('Attribute Name',null), 'info' => _text('Attribute Name [Info]', null), 'required' => true, ));        
        
            /** element `attribute_type` id=2569 **/
            $this->addElement(array ( 'name' => 'attribute_type', 'factory' => 'text', 'label' => _text('Attribute Type',null), 'placeholder' => _text('Attribute Type',null), 'info' => _text('Attribute Type [Info]', null), 'value' => 'text', 'required' => true, ));        
        
            /** element `attribute_label` id=2570 **/
            $this->addElement(array ( 'name' => 'attribute_label', 'factory' => 'text', 'label' => _text('Attribute Label',null), 'placeholder' => _text('Attribute Label',null), 'info' => _text('Attribute Label [Info]', null), 'required' => true, ));        
        
            /** element `is_basic` id=2571 **/
            $this->addElement(array ( 'name' => 'is_basic', 'factory' => 'yesno', 'label' => _text('Is Basic',null), 'placeholder' => _text('Is Basic',null), 'info' => _text('Is Basic [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_require` id=2572 **/
            $this->addElement(array ( 'name' => 'is_require', 'factory' => 'yesno', 'label' => _text('Is Require',null), 'placeholder' => _text('Is Require',null), 'info' => _text('Is Require [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `ordering` id=2573 **/
            $this->addElement(array ( 'name' => 'ordering', 'factory' => 'text', 'label' => _text('Ordering',null), 'placeholder' => _text('Ordering',null), 'info' => _text('Ordering [Info]', null), 'value' => '100', 'required' => true, ));        
        
            /** element `attribute_options` id=2574 **/
            $this->addElement(array ( 'name' => 'attribute_options', 'factory' => 'textarea', 'label' => _text('Attribute Options',null), 'placeholder' => _text('Attribute Options',null), 'info' => _text('Attribute Options [Info]', null), ));        
        
            /** element `is_system` id=2575 **/
            $this->addElement(array ( 'name' => 'is_system', 'factory' => 'yesno', 'label' => _text('Is System',null), 'placeholder' => _text('Is System',null), 'info' => _text('Is System [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_active` id=2576 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'placeholder' => _text('Is Active',null), 'info' => _text('Is Active [Info]', null), 'value' => '1', 'required' => true, ));        
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
