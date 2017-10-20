<?php
namespace Neutron\Pages\Form\Admin\PagesLevel;

use Phpfox\Form\Form;

class AddPagesLevel extends Form {

    /** id=773 */
    public function initialize(){

        $this->setTitle(_text('Add Level','_pages'));
        $this->setInfo(_text('Add Level [Form Info]','_pages'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `inherit_id` id=2999 **/
            $this->addElement(array ( 'name' => 'inherit_id', 'factory' => 'text', 'label' => _text('Inherit Id','_pages'), 'placeholder' => _text('Inherit Id','_pages'), 'info' => _text('Inherit Id [Info]', '_pages'), 'value' => '0', 'required' => true, ));        
        
            /** element `title` id=3000 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'label' => _text('Title','_pages'), 'placeholder' => _text('Title','_pages'), 'info' => _text('Title [Info]', '_pages'), 'required' => true, ));        
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
