<?php
namespace Neutron\Group\Form\Admin\GroupLevel;

use Phpfox\Form\Form;

class AddGroupLevel extends Form {

    /** id=779 */
    public function initialize(){

        $this->setTitle(_text('Add Group Level',''));
        $this->setInfo(_text('Add Group Level [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `inherit_id` id=3075 **/
            $this->addElement(array ( 'name' => 'inherit_id', 'factory' => 'text', 'label' => _text('Inherit Id',null), 'placeholder' => _text('Inherit Id',null), 'info' => _text('Inherit Id [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `title` id=3076 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'label' => _text('Title',null), 'placeholder' => _text('Title',null), 'info' => _text('Title [Info]', null), 'required' => true, ));        
        
            /** element `is_core` id=3078 **/
            $this->addElement(array ( 'name' => 'is_core', 'factory' => 'yesno', 'label' => _text('Is Core',null), 'placeholder' => _text('Is Core',null), 'info' => _text('Is Core [Info]', null), 'value' => '0', 'required' => true, ));        
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
