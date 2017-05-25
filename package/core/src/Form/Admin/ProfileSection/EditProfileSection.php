<?php
namespace Neutron\Core\Form\Admin\ProfileSection;

use Phpfox\Form\Form;

class EditProfileSection extends Form {

    /** id=754 */
    public function initialize(){

        $this->setTitle(_text('Edit Profile Section',''));
        $this->setInfo(_text('[Edit Profile Section Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `process_id` id=2595 **/
            $this->addElement(array ( 'name' => 'process_id', 'factory' => 'text', 'label' => _text('Process Id',null), 'placeholder' => _text('Process Id',null), 'info' => _text('Process Id [Info]', null), 'required' => true, ));        
        
            /** element `section_name` id=2596 **/
            $this->addElement(array ( 'name' => 'section_name', 'factory' => 'text', 'label' => _text('Section Name',null), 'placeholder' => _text('Section Name',null), 'info' => _text('Section Name [Info]', null), 'required' => true, ));        
        
            /** element `section_label` id=2597 **/
            $this->addElement(array ( 'name' => 'section_label', 'factory' => 'text', 'label' => _text('Section Label',null), 'placeholder' => _text('Section Label',null), 'info' => _text('Section Label [Info]', null), 'required' => true, ));        
        
            /** element `ordering` id=2598 **/
            $this->addElement(array ( 'name' => 'ordering', 'factory' => 'text', 'label' => _text('Ordering',null), 'placeholder' => _text('Ordering',null), 'info' => _text('Ordering [Info]', null), 'value' => '10', 'required' => true, ));        
        
            /** element `is_active` id=2599 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'placeholder' => _text('Is Active',null), 'info' => _text('Is Active [Info]', null), 'value' => '1', 'required' => true, ));        
        
            /** element `dependencies` id=2600 **/
            $this->addElement(array ( 'name' => 'dependencies', 'factory' => 'textarea', 'label' => _text('Dependencies',null), 'placeholder' => _text('Dependencies',null), 'info' => _text('Dependencies [Info]', null), ));        
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
