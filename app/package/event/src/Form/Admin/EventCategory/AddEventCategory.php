<?php
namespace Neutron\Event\Form\Admin\EventCategory;

use Phpfox\Form\Form;

class AddEventCategory extends Form {

    /** id=44 */
    public function initialize(){

        $this->setTitle(_text('Add Event Category','_event'));
        $this->setInfo(_text('Add Event Category [Form Info]','_event'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3237 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_event'), 'placeholder' => _text('Is Active','_event'), 'info' => _text('Is Active [Info]', '_event'), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3238 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name','_event'), 'placeholder' => _text('Name','_event'), 'info' => _text('Name [Info]', '_event'), 'required' => true, ));        
        
            /** element `description` id=3239 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description','_event'), 'placeholder' => _text('Description','_event'), 'info' => _text('Description [Info]', '_event'), ));        
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
            'href'       => _url('admin.event.category'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
            ]);
    }
}
