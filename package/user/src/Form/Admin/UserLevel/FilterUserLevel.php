<?php
namespace Neutron\User\Form\Admin\UserLevel;

use Phpfox\Form\Form;

class FilterUserLevel extends Form {

    /** id=704 */
    public function initialize(){

        $this->setMethod('get');

        /** start elements **/

        
        
            /** element `q` id=2362 **/
            $this->addElement(array ( 'name' => 'q', 'factory' => 'text', 'placeholder' => _text('Keywords',null), ));        
        
            /** element `is_core` id=3124 **/
            $this->addElement(array ( 'name' => 'is_core', 'factory' => 'yesno', 'placeholder' => _text('Is Core',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `inherit_id` id=2351 **/
            $this->addElement(array ( 'name' => 'inherit_id', 'factory' => 'text', 'placeholder' => _text('Inherit',null), 'value' => '0', ));        
        
            /** element `title` id=2352 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'placeholder' => _text('Title',null), ));        
        
            /** element `is_special` id=2354 **/
            $this->addElement(array ( 'name' => 'is_special', 'factory' => 'yesno', 'placeholder' => _text('Is Special',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_super` id=2355 **/
            $this->addElement(array ( 'name' => 'is_super', 'factory' => 'yesno', 'placeholder' => _text('Is Super',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_admin` id=2356 **/
            $this->addElement(array ( 'name' => 'is_admin', 'factory' => 'yesno', 'placeholder' => _text('Is Admin',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_moderator` id=2357 **/
            $this->addElement(array ( 'name' => 'is_moderator', 'factory' => 'yesno', 'placeholder' => _text('Is Moderator',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_staff` id=2358 **/
            $this->addElement(array ( 'name' => 'is_staff', 'factory' => 'yesno', 'placeholder' => _text('Is Staff',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_registered` id=2359 **/
            $this->addElement(array ( 'name' => 'is_registered', 'factory' => 'yesno', 'placeholder' => _text('Is Registered',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_banned` id=2360 **/
            $this->addElement(array ( 'name' => 'is_banned', 'factory' => 'yesno', 'placeholder' => _text('Is Banned',null), 'value' => '0', 'decorator' => 'select', ));        
        
            /** element `is_guest` id=2361 **/
            $this->addElement(array ( 'name' => 'is_guest', 'factory' => 'yesno', 'placeholder' => _text('Is Guest',null), 'value' => '0', 'decorator' => 'select', ));        
        /** end elements **/

        $this->addButton([
            'name'       => 'search',
            'factory'=>'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);
    }
}
