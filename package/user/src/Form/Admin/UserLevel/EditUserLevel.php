<?php
namespace Neutron\User\Form\Admin\UserLevel;

use Phpfox\Form\Form;

class EditUserLevel extends Form {

    /** id=700 */
    public function initialize(){

        $this->setTitle(_text('Edit User Level',''));
        $this->setInfo(_text('Edit User Level [Form Info]',''));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_core` id=3122 **/
            $this->addElement(array ( 'name' => 'is_core', 'factory' => 'yesno', 'label' => _text('Is Core',null), 'placeholder' => _text('Is Core',null), 'info' => _text('Is Core [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `inherit_id` id=2327 **/
            $this->addElement(array ( 'name' => 'inherit_id', 'factory' => 'text', 'label' => _text('Inherit Id',null), 'placeholder' => _text('Inherit Id',null), 'info' => _text('Inherit Id [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `title` id=2328 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'label' => _text('Title',null), 'placeholder' => _text('Title',null), 'info' => _text('Title [Info]', null), 'required' => true, ));        
        
            /** element `is_special` id=2330 **/
            $this->addElement(array ( 'name' => 'is_special', 'factory' => 'yesno', 'label' => _text('Is Special',null), 'placeholder' => _text('Is Special',null), 'info' => _text('Is Special [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_super` id=2331 **/
            $this->addElement(array ( 'name' => 'is_super', 'factory' => 'yesno', 'label' => _text('Is Super',null), 'placeholder' => _text('Is Super',null), 'info' => _text('Is Super [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_admin` id=2332 **/
            $this->addElement(array ( 'name' => 'is_admin', 'factory' => 'yesno', 'label' => _text('Is Admin',null), 'placeholder' => _text('Is Admin',null), 'info' => _text('Is Admin [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_moderator` id=2333 **/
            $this->addElement(array ( 'name' => 'is_moderator', 'factory' => 'yesno', 'label' => _text('Is Moderator',null), 'placeholder' => _text('Is Moderator',null), 'info' => _text('Is Moderator [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_staff` id=2334 **/
            $this->addElement(array ( 'name' => 'is_staff', 'factory' => 'yesno', 'label' => _text('Is Staff',null), 'placeholder' => _text('Is Staff',null), 'info' => _text('Is Staff [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_registered` id=2335 **/
            $this->addElement(array ( 'name' => 'is_registered', 'factory' => 'yesno', 'label' => _text('Is Registered',null), 'placeholder' => _text('Is Registered',null), 'info' => _text('Is Registered [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_banned` id=2336 **/
            $this->addElement(array ( 'name' => 'is_banned', 'factory' => 'yesno', 'label' => _text('Is Banned',null), 'placeholder' => _text('Is Banned',null), 'info' => _text('Is Banned [Info]', null), 'value' => '0', 'required' => true, ));        
        
            /** element `is_guest` id=2337 **/
            $this->addElement(array ( 'name' => 'is_guest', 'factory' => 'yesno', 'label' => _text('Is Guest',null), 'placeholder' => _text('Is Guest',null), 'info' => _text('Is Guest [Info]', null), 'value' => '0', 'required' => true, ));        
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
