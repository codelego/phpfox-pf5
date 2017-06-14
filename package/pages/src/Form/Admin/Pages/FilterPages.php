<?php
namespace Neutron\Pages\Form\Admin\Pages;

use Phpfox\Form\Form;

class FilterPages extends Form {

    /** id=416 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=2997 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords',null), ));        
        
            /** element `is_featured` id=2985 **/
            $this->addElement(array ( 'name' => 'is_featured', 'factory' => 'yesno', 'placeholder' => _text('Is Featured',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_sponsor` id=2986 **/
            $this->addElement(array ( 'name' => 'is_sponsor', 'factory' => 'yesno', 'placeholder' => _text('Is Sponsor',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `type_id` id=2987 **/
            $this->addElement(array ( 'name' => 'type_id', 'factory' => 'text', 'placeholder' => _text('Type',null), ));        
        
            /** element `category_id` id=2988 **/
            $this->addElement(array ( 'name' => 'category_id', 'factory' => 'text', 'placeholder' => _text('Category',null), ));        
        
            /** element `profile_name` id=2990 **/
            $this->addElement(array ( 'name' => 'profile_name', 'factory' => 'text', 'placeholder' => _text('Profile Name',null), ));        
        
            /** element `title` id=2991 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'placeholder' => _text('Title',null), ));        
        
            /** element `photo_id` id=2992 **/
            $this->addElement(array ( 'name' => 'photo_id', 'factory' => 'text', 'placeholder' => _text('Photo',null), 'value' => '0', ));        
        
            /** element `cover_photo_id` id=2993 **/
            $this->addElement(array ( 'name' => 'cover_photo_id', 'factory' => 'text', 'placeholder' => _text('Cover Photo',null), ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
