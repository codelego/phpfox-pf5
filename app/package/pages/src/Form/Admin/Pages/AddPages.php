<?php
namespace Neutron\Pages\Form\Admin\Pages;

use Phpfox\Form\Form;

class AddPages extends Form {

    /** id=86 */
    public function initialize(){

        $this->setTitle(_text('Add Pages',''));
        $this->setInfo(_text('Add Pages [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_featured` id=2946 **/
            $this->addElement(array ( 'name' => 'is_featured', 'factory' => 'yesno', 'label' => _text('Is Featured',null), 'placeholder' => _text('Is Featured',null), 'info' => _text('Is Featured [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_sponsor` id=2947 **/
            $this->addElement(array ( 'name' => 'is_sponsor', 'factory' => 'yesno', 'label' => _text('Is Sponsor',null), 'placeholder' => _text('Is Sponsor',null), 'info' => _text('Is Sponsor [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `type_id` id=2948 **/
            $this->addElement(array ( 'name' => 'type_id', 'factory' => 'text', 'label' => _text('Type Id',null), 'placeholder' => _text('Type Id',null), 'info' => _text('Type Id [Info]', null), 'required' => true, ));        
        
            /** element `category_id` id=2949 **/
            $this->addElement(array ( 'name' => 'category_id', 'factory' => 'text', 'label' => _text('Category Id',null), 'placeholder' => _text('Category Id',null), 'info' => _text('Category Id [Info]', null), 'required' => true, ));        
        
            /** element `profile_name` id=2951 **/
            $this->addElement(array ( 'name' => 'profile_name', 'factory' => 'text', 'label' => _text('Profile Name',null), 'placeholder' => _text('Profile Name',null), 'info' => _text('Profile Name [Info]', null), ));        
        
            /** element `title` id=2952 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'label' => _text('Title',null), 'placeholder' => _text('Title',null), 'info' => _text('Title [Info]', null), 'required' => true, ));        
        
            /** element `photo_id` id=2953 **/
            $this->addElement(array ( 'name' => 'photo_id', 'factory' => 'text', 'label' => _text('Photo Id',null), 'placeholder' => _text('Photo Id',null), 'info' => _text('Photo Id [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `cover_photo_id` id=2954 **/
            $this->addElement(array ( 'name' => 'cover_photo_id', 'factory' => 'text', 'label' => _text('Cover Photo Id',null), 'placeholder' => _text('Cover Photo Id',null), 'info' => _text('Cover Photo Id [Info]', null), 'required' => true, ));        
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
