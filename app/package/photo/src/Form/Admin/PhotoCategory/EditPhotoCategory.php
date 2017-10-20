<?php
namespace Neutron\Photo\Form\Admin\PhotoCategory;

use Phpfox\Form\Form;

class EditPhotoCategory extends Form {

    /** id=204 */
    public function initialize(){

        $this->setTitle(_text('Edit Photo Category',''));
        $this->setInfo(_text('Edit Photo Category [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3384 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active',null), 'placeholder' => _text('Is Active',null), 'info' => _text('Is Active [Info]', null), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3385 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name',null), 'placeholder' => _text('Name',null), 'info' => _text('Name [Info]', null), 'required' => true, ));        
        
            /** element `description` id=3386 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description',null), 'placeholder' => _text('Description',null), 'info' => _text('Description [Info]', null), ));        
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
