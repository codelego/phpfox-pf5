<?php
namespace Neutron\Core\Form\Admin\CoreMenuItem;

use Phpfox\Form\Form;

class EditCoreMenuItem extends Form {

    /** id=709 */
    public function initialize(){

        $this->setTitle(_text('Edit Core Menu Item','_core.menu'));
        $this->setInfo(_text('Edit Core Menu Item [Form Info]','_core.menu'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `label` id=2768 **/
            $this->addElement(array ( 'name' => 'label', 'factory' => 'text', 'label' => _text('Label','_core.menu'), 'placeholder' => _text('Label','_core.menu'), 'info' => _text('Label [Info]', '_core.menu'), 'required' => true, ));        
        
            /** element `href` id=2780 **/
            $this->addElement(array ( 'name' => 'href', 'factory' => 'text', 'label' => _text('Href','_core.menu'), 'placeholder' => _text('Href','_core.menu'), 'info' => _text('Href [Info]', '_core.menu'), ));        
        
            /** element `is_self` id=2837 **/
            $this->addElement(array ( 'name' => 'is_self', 'factory' => 'yesno', 'label' => _text('Is Self','_core.menu'), 'placeholder' => _text('Is Self','_core.menu'), 'info' => _text('Is Self [Info]', '_core.menu'), 'value' => '1', 'required' => true, ));        
        
            /** element `is_active` id=2775 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_core.menu'), 'placeholder' => _text('Is Active','_core.menu'), 'info' => _text('Is Active [Info]', '_core.menu'), 'value' => '1', 'required' => true, ));        
        
            /** element `is_ajax` id=2836 **/
            $this->addElement(array ( 'name' => 'is_ajax', 'factory' => 'yesno', 'label' => _text('Is Ajax','_core.menu'), 'placeholder' => _text('Is Ajax','_core.menu'), 'info' => _text('Is Ajax [Info]', '_core.menu'), 'value' => '1', 'required' => true, ));        
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
