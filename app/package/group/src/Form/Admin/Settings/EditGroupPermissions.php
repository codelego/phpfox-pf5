<?php
namespace Neutron\Group\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditGroupPermissions extends Form {

    /** id=809 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_group'));
        $this->setInfo(_text('[Edit Permissions Info]','_group'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `group__add_group` id=3430 **/
            $this->addElement(array ( 'name' => 'group__add_group', 'factory' => 'yesno', 'label' => _text('Can Add Group','_group'), 'placeholder' => _text('Can Add Group','_group'), 'info' => _text('Can Add Group [Info]', '_group'), 'required' => true, ));        
        
            /** element `group__edit_group` id=3431 **/
            $this->addElement(array ( 'name' => 'group__edit_group', 'factory' => 'yesno', 'label' => _text('Can Edit Group','_group'), 'placeholder' => _text('Can Edit Group','_group'), 'info' => _text('Can Edit Group [Info]', '_group'), 'required' => true, ));        
        
            /** element `group__delete_group` id=3432 **/
            $this->addElement(array ( 'name' => 'group__delete_group', 'factory' => 'yesno', 'label' => _text('Can Delete Group','_group'), 'placeholder' => _text('Can Delete Group','_group'), 'info' => _text('Can Delete Group [Info]', '_group'), 'required' => true, ));        
        
            /** element `group__limit_group` id=3433 **/
            $this->addElement(array ( 'name' => 'group__limit_group', 'factory' => 'yesno', 'label' => _text('Limit Group','_group'), 'placeholder' => _text('Limit Group','_group'), 'info' => _text('Limit Group [Info]', '_group'), 'value' => '0', 'required' => true, ));        
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
