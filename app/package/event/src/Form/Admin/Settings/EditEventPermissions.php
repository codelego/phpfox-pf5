<?php
namespace Neutron\Event\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditEventPermissions extends Form {

    /** id=817 */
    public function initialize(){

        $this->setTitle(_text('Edit Event','_event'));
        $this->setInfo(_text('[Edit Event Info]','_event'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `event__add_event` id=3486 **/
            $this->addElement(array ( 'name' => 'event__add_event', 'factory' => 'yesno', 'label' => _text('Can Add Event','_event'), 'placeholder' => _text('Can Add Event','_event'), 'info' => _text('Can Add Event [Info]', '_event'), 'value' => '1', 'required' => true, ));        
        
            /** element `event__edit_event` id=3487 **/
            $this->addElement(array ( 'name' => 'event__edit_event', 'factory' => 'yesno', 'label' => _text('Can Edit Event','_event'), 'placeholder' => _text('Can Edit Event','_event'), 'info' => _text('Can Edit Event [Info]', '_event'), 'value' => '1', 'required' => true, ));        
        
            /** element `event__delete_event` id=3488 **/
            $this->addElement(array ( 'name' => 'event__delete_event', 'factory' => 'yesno', 'label' => _text('Can Delete Event','_event'), 'placeholder' => _text('Can Delete Event','_event'), 'info' => _text('Can Delete Event [Info]', '_event'), 'value' => '1', 'required' => true, ));        
        
            /** element `event__approval` id=3490 **/
            $this->addElement(array ( 'name' => 'event__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_event'), 'placeholder' => _text('Approval Process','_event'), 'info' => _text('Approval Process [Info]', '_event'), 'value' => '0', 'required' => true, ));        
        
            /** element `event__join_event` id=3492 **/
            $this->addElement(array ( 'name' => 'event__join_event', 'factory' => 'yesno', 'label' => _text('Can Join Event','_event'), 'placeholder' => _text('Can Join Event','_event'), 'info' => _text('Can Join Event [Info]', '_event'), 'value' => '1', 'required' => true, ));        
        
            /** element `event__invite_event` id=3493 **/
            $this->addElement(array ( 'name' => 'event__invite_event', 'factory' => 'yesno', 'label' => _text('Can Invite Others','_event'), 'placeholder' => _text('Can Invite Others','_event'), 'info' => _text('Can Invite Others [Info]', '_event'), 'value' => '1', 'required' => true, ));        
        
            /** element `event__limit_event` id=3489 **/
            $this->addElement(array ( 'name' => 'event__limit_event', 'factory' => 'text', 'label' => _text('Limit Event','_event'), 'placeholder' => _text('Limit Event','_event'), 'info' => _text('Limit Event [Info]', '_event'), 'value' => '0', 'required' => true, ));        
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
