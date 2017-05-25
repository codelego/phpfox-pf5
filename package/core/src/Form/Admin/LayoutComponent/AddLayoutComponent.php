<?php
namespace Neutron\Core\Form\Admin\LayoutComponent;

use Phpfox\Form\Form;

class AddLayoutComponent extends Form {

    /** id=67 */
    public function initialize(){

        $this->setTitle(_text('Add Layout Component','_core.component'));
        $this->setInfo(_text('Add Layout Component [Form Info]','_core.component'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `component_name` id=951 **/
            $this->addElement(array ( 'name' => 'component_name', 'factory' => 'text', 'label' => _text('Title','_core.component'), 'placeholder' => _text('Title','_core.component'), 'required' => true, ));        
        
            /** element `component_class` id=952 **/
            $this->addElement(array ( 'name' => 'component_class', 'factory' => 'text', 'label' => _text('Class','_core.component'), 'placeholder' => _text('Class','_core.component'), 'info' => _text('Class Name [Info]', '_core.component'), ));        
        
            /** element `description` id=957 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description','_core.component'), 'placeholder' => _text('Description','_core.component'), ));        
        
            /** element `is_active` id=955 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_core.component'), 'placeholder' => _text('Is Active','_core.component'), 'info' => _text('Is Active [Info]', '_core.component'), 'value' => '1', 'required' => true, ));        
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
