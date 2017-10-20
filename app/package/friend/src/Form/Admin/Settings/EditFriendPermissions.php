<?php
namespace Neutron\Friend\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditFriendPermissions extends Form {

    /** id=816 */
    public function initialize(){

        $this->setTitle(_text('Edit Friend','_friend'));
        $this->setInfo(_text('[Edit Friend Info]','_friend'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `friend__add_friend` id=3479 **/
            $this->addElement(array ( 'name' => 'friend__add_friend', 'factory' => 'yesno', 'label' => _text('Can Add Friend','_friend'), 'placeholder' => _text('Can Add Friend','_friend'), 'info' => _text('Can Add Friend [Info]', '_friend'), 'value' => '1', 'required' => true, ));        
        
            /** element `friend__delete_friend` id=3480 **/
            $this->addElement(array ( 'name' => 'friend__delete_friend', 'factory' => 'yesno', 'label' => _text('Can Delete Friend','_friend'), 'placeholder' => _text('Can Delete Friend','_friend'), 'info' => _text('Can Delete Friend [Info]', '_friend'), 'value' => '1', 'required' => true, ));        
        
            /** element `friend__add_list` id=3482 **/
            $this->addElement(array ( 'name' => 'friend__add_list', 'factory' => 'yesno', 'label' => _text('Can Add Custom List','_friend'), 'placeholder' => _text('Can Add Custom List','_friend'), 'info' => _text('Can Add Custom List [Info]', '_friend'), 'value' => '1', 'required' => true, ));        
        
            /** element `friend__edit_list` id=3483 **/
            $this->addElement(array ( 'name' => 'friend__edit_list', 'factory' => 'yesno', 'label' => _text('Can Edit Custom List','_friend'), 'placeholder' => _text('Can Edit Custom List','_friend'), 'info' => _text('Can Edit Custom List [Info]', '_friend'), 'value' => '1', 'required' => true, ));        
        
            /** element `friend__delete_list` id=3484 **/
            $this->addElement(array ( 'name' => 'friend__delete_list', 'factory' => 'yesno', 'label' => _text('Can Delete Custom List','_friend'), 'placeholder' => _text('Can Delete Custom List','_friend'), 'info' => _text('Can Delete Custom List [Info]', '_friend'), 'value' => '1', 'required' => true, ));        
        
            /** element `friend__limit_friend` id=3481 **/
            $this->addElement(array ( 'name' => 'friend__limit_friend', 'factory' => 'text', 'label' => _text('Limit Friend','_friend'), 'placeholder' => _text('Limit Friend','_friend'), 'info' => _text('Limit Friend [Info]', '_friend'), 'value' => '0', 'required' => true, ));        
        
            /** element `friend__limit_list` id=3485 **/
            $this->addElement(array ( 'name' => 'friend__limit_list', 'factory' => 'text', 'label' => _text('Limit Custom List','_friend'), 'placeholder' => _text('Limit Custom List','_friend'), 'info' => _text('Limit Custom List [Info]', '_friend'), 'value' => '0', 'required' => true, ));        
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
