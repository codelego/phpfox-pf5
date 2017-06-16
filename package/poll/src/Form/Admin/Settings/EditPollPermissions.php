<?php
namespace Neutron\Poll\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditPollPermissions extends Form {

    /** id=812 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_poll'));
        $this->setInfo(_text('[Edit Permissions Info]','_poll'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `poll__add_poll` id=3448 **/
            $this->addElement(array ( 'name' => 'poll__add_poll', 'factory' => 'yesno', 'label' => _text('Can Add Poll','_poll'), 'placeholder' => _text('Can Add Poll','_poll'), 'info' => _text('Can Add Poll [Info]', '_poll'), 'required' => true, ));        
        
            /** element `poll__edit_poll` id=3449 **/
            $this->addElement(array ( 'name' => 'poll__edit_poll', 'factory' => 'yesno', 'label' => _text('Can Edit Poll','_poll'), 'placeholder' => _text('Can Edit Poll','_poll'), 'info' => _text('Can Edit Poll [Info]', '_poll'), 'required' => true, ));        
        
            /** element `poll__delete_poll` id=3450 **/
            $this->addElement(array ( 'name' => 'poll__delete_poll', 'factory' => 'yesno', 'label' => _text('Can Delete Poll','_poll'), 'placeholder' => _text('Can Delete Poll','_poll'), 'info' => _text('Can Delete Poll [Info]', '_poll'), 'required' => true, ));        
        
            /** element `poll__limit_poll` id=3451 **/
            $this->addElement(array ( 'name' => 'poll__limit_poll', 'factory' => 'text', 'label' => _text('Limit Poll','_poll'), 'placeholder' => _text('Limit Poll','_poll'), 'info' => _text('Limit Poll [Info]', '_poll'), 'value' => '0', 'required' => true, ));        
        
            /** element `poll__approval` id=3452 **/
            $this->addElement(array ( 'name' => 'poll__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_poll'), 'placeholder' => _text('Approval Process','_poll'), 'info' => _text('Approval Process [Info]', '_poll'), 'required' => true, ));        
        
            /** element `poll__limit_answer` id=3476 **/
            $this->addElement(array ( 'name' => 'poll__limit_answer', 'factory' => 'text', 'label' => _text('Limit Answer','_poll'), 'placeholder' => _text('Limit Answer','_poll'), 'info' => _text('Limit Answer [Info]', '_poll'), 'value' => '0', 'required' => true, ));        
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
