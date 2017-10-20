<?php
namespace Neutron\Pages\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditPagesPermissions extends Form {

    /** id=806 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_pages'));
        $this->setInfo(_text('[Edit Permissions Info]','_pages'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `pages__add_pages` id=3438 **/
            $this->addElement(array ( 'name' => 'pages__add_pages', 'factory' => 'yesno', 'label' => _text('Can Add Pages','_pages'), 'placeholder' => _text('Can Add Pages','_pages'), 'info' => _text('Can Add Pages [Info]', '_pages'), 'value' => '1', 'required' => true, ));        
        
            /** element `pages__edit_pages` id=3440 **/
            $this->addElement(array ( 'name' => 'pages__edit_pages', 'factory' => 'yesno', 'label' => _text('Can Edit Pages','_pages'), 'placeholder' => _text('Can Edit Pages','_pages'), 'info' => _text('Can Edit Pages [Info]', '_pages'), 'value' => '1', 'required' => true, ));        
        
            /** element `pages__delete_pages` id=3439 **/
            $this->addElement(array ( 'name' => 'pages__delete_pages', 'factory' => 'yesno', 'label' => _text('Can Delete Pages','_pages'), 'placeholder' => _text('Can Delete Pages','_pages'), 'info' => _text('Can Delete Pages [Info]', '_pages'), 'value' => '1', 'required' => true, ));        
        
            /** element `pages__limit_pages` id=3441 **/
            $this->addElement(array ( 'name' => 'pages__limit_pages', 'factory' => 'text', 'label' => _text('Limit Pages','_pages'), 'placeholder' => _text('Limit Pages','_pages'), 'info' => _text('Limit Pages [Info]', '_pages'), 'value' => '10', 'required' => true, ));        
        
            /** element `pages__approval` id=3420 **/
            $this->addElement(array ( 'name' => 'pages__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_pages'), 'placeholder' => _text('Approval Process','_pages'), 'info' => _text('Approval Process [Info]', '_pages'), 'value' => '0', 'required' => true, ));        
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
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
