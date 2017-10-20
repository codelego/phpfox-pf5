<?php
namespace Neutron\Core\Form\Admin\ProfileSection;

use Phpfox\Form\Form;

class AddProfileSection extends Form {

    /** id=753 */
    public function initialize(){

        $this->setTitle(_text('Add Profile Section',''));
        $this->setInfo(_text('[Add Profile Section Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `section_label` id=2737 **/
            $this->addElement(array ( 'name' => 'section_label', 'factory' => 'text', 'label' => _text('Title',null), 'placeholder' => _text('Title',null), 'info' => _text('Section Label [Info]', null), 'required' => true, ));        
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
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
