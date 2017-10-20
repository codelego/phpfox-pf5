<?php
namespace Neutron\Pages\Form\Admin\PagesCategory;

use Phpfox\Form\Form;

class EditPagesCategory extends Form {

    /** id=197 */
    public function initialize(){

        $this->setTitle(_text('Edit Pages Category','_pages'));
        $this->setInfo(_text('Edit Pages Category [Form Info]','_pages'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3188 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_pages'), 'placeholder' => _text('Is Active','_pages'), 'info' => _text('Is Active [Info]', '_pages'), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3189 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name','_pages'), 'placeholder' => _text('Name','_pages'), 'info' => _text('Name [Info]', '_pages'), 'required' => true, ));        
        
            /** element `description` id=3190 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description','_pages'), 'placeholder' => _text('Description','_pages'), 'info' => _text('Description [Info]', '_pages'), ));        
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
            'href'       => _url('admin.pages.category'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
