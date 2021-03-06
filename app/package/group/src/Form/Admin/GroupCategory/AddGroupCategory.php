<?php
namespace Neutron\Group\Form\Admin\GroupCategory;

use Phpfox\Form\Form;

class AddGroupCategory extends Form {

    /** id=55 */
    public function initialize(){

        $this->setTitle(_text('Add Group Category',''));
        $this->setInfo(_text('Add Group Category [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3221 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'placeholder' => _text('Is Active',null), 'info' => _text('Is Active [Info]', null), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3222 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name',null), 'placeholder' => _text('Name',null), 'info' => _text('Name [Info]', null), 'required' => true, ));        
        
            /** element `description` id=3223 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description',null), 'placeholder' => _text('Description',null), 'info' => _text('Description [Info]', null), ));        
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
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]);
    }
}
