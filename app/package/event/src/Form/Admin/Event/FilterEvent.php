<?php
namespace Neutron\Event\Form\Admin\Event;

use Phpfox\Form\Form;

class FilterEvent extends Form {

    /** id=373 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=3161 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords',null), ));        
        
            /** element `is_featured` id=3147 **/
            $this->addElement(array ( 'name' => 'is_featured', 'factory' => 'yesno', 'placeholder' => _text('Is Featured',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_sponsor` id=3148 **/
            $this->addElement(array ( 'name' => 'is_sponsor', 'factory' => 'yesno', 'placeholder' => _text('Is Sponsor',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `privacy_id` id=3149 **/
            $this->addElement(array ( 'name' => 'privacy_id', 'factory' => 'text', 'placeholder' => _text('Privacy',null), 'value' => '0', ));        
        
            /** element `location_id` id=3153 **/
            $this->addElement(array ( 'name' => 'location_id', 'factory' => 'text', 'placeholder' => _text('Location',null), 'value' => '0', ));        
        
            /** element `photo_id` id=3154 **/
            $this->addElement(array ( 'name' => 'photo_id', 'factory' => 'text', 'placeholder' => _text('Photo',null), 'value' => '0', ));        
        
            /** element `start_at` id=3155 **/
            $this->addElement(array ( 'name' => 'start_at', 'factory' => 'text', 'placeholder' => _text('Start At',null), ));        
        
            /** element `end_at` id=3156 **/
            $this->addElement(array ( 'name' => 'end_at', 'factory' => 'text', 'placeholder' => _text('End At',null), ));        
        
            /** element `title` id=3158 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'textarea', 'placeholder' => _text('Title',null), 'decorator' => 'text', ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
