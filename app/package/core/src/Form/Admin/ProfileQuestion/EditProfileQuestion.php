<?php
namespace Neutron\Core\Form\Admin\ProfileQuestion;

use Phpfox\Form\Form;

class EditProfileQuestion extends Form {

    /** id=742 */
    public function initialize(){

        $this->setTitle(_text('Edit Profile Question',''));
        $this->setInfo(_text('[Edit Profile Question Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `section_id` id=2578 **/
            $this->addElement(array ( 'name' => 'section_id', 'factory' => 'text', 'label' => _text('Section Id',null), 'placeholder' => _text('Section Id',null), 'info' => _text('Section Id [Info]', null), 'value' => '1', ));        
        
            /** element `attribute_id` id=2579 **/
            $this->addElement(array ( 'name' => 'attribute_id', 'factory' => 'text', 'label' => _text('Attribute Id',null), 'placeholder' => _text('Attribute Id',null), 'info' => _text('Attribute Id [Info]', null), 'value' => '0', ));        
        
            /** element `internal_id` id=2580 **/
            $this->addElement(array ( 'name' => 'internal_id', 'factory' => 'text', 'label' => _text('Internal Id',null), 'placeholder' => _text('Internal Id',null), 'info' => _text('Internal Id [Info]', null), ));        
        
            /** element `factory_id` id=2581 **/
            $this->addElement(array ( 'name' => 'factory_id', 'factory' => 'text', 'label' => _text('Factory Id',null), 'placeholder' => _text('Factory Id',null), 'info' => _text('Factory Id [Info]', null), 'value' => 'text', 'required' => true, ));        
        
            /** element `question_label` id=2582 **/
            $this->addElement(array ( 'name' => 'question_label', 'factory' => 'text', 'label' => _text('Question Label',null), 'placeholder' => _text('Question Label',null), 'info' => _text('Question Label [Info]', null), 'required' => true, ));        
        
            /** element `placeholder` id=2583 **/
            $this->addElement(array ( 'name' => 'placeholder', 'factory' => 'text', 'label' => _text('Placeholder',null), 'placeholder' => _text('Placeholder',null), 'info' => _text('Placeholder [Info]', null), 'required' => true, ));        
        
            /** element `info` id=2584 **/
            $this->addElement(array ( 'name' => 'info', 'factory' => 'text', 'label' => _text('Info',null), 'placeholder' => _text('Info',null), 'info' => _text('Info [Info]', null), 'required' => true, ));        
        
            /** element `note` id=2585 **/
            $this->addElement(array ( 'name' => 'note', 'factory' => 'text', 'label' => _text('Note',null), 'placeholder' => _text('Note',null), 'info' => _text('Note [Info]', null), 'required' => true, ));        
        
            /** element `is_active` id=2586 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'placeholder' => _text('Is Active',null), 'info' => _text('Is Active [Info]', null), 'value' => '1', 'required' => true, ));        
        
            /** element `is_require` id=2587 **/
            $this->addElement(array ( 'name' => 'is_require', 'factory' => 'yesno', 'label' => _text('Is Require',null), 'placeholder' => _text('Is Require',null), 'info' => _text('Is Require [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `ordering` id=2588 **/
            $this->addElement(array ( 'name' => 'ordering', 'factory' => 'text', 'label' => _text('Ordering',null), 'placeholder' => _text('Ordering',null), 'info' => _text('Ordering [Info]', null), 'value' => '100', 'required' => true, ));        
        
            /** element `options` id=2589 **/
            $this->addElement(array ( 'name' => 'options', 'factory' => 'textarea', 'label' => _text('Options',null), 'placeholder' => _text('Options',null), 'info' => _text('Options [Info]', null), 'required' => true, ));        
        
            /** element `dependencies` id=2590 **/
            $this->addElement(array ( 'name' => 'dependencies', 'factory' => 'text', 'label' => _text('Dependencies',null), 'placeholder' => _text('Dependencies',null), 'info' => _text('Dependencies [Info]', null), ));        
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
