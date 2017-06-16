<?php
namespace Neutron\Photo\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditPhotoPermissions extends Form {

    /** id=811 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_photo'));
        $this->setInfo(_text('[Edit Permissions Info]','_photo'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `photo__add_photo` id=3442 **/
            $this->addElement(array ( 'name' => 'photo__add_photo', 'factory' => 'yesno', 'label' => _text('Can Add Photo','_photo'), 'placeholder' => _text('Can Add Photo','_photo'), 'info' => _text('Can Add Photo [Info]', '_photo'), 'value' => '1', 'required' => true, ));        
        
            /** element `photo__edit_photo` id=3443 **/
            $this->addElement(array ( 'name' => 'photo__edit_photo', 'factory' => 'yesno', 'label' => _text('Can Edit Photo','_photo'), 'placeholder' => _text('Can Edit Photo','_photo'), 'info' => _text('Can Edit Photo [Info]', '_photo'), 'value' => '1', 'required' => true, ));        
        
            /** element `photo__delete_photo` id=3444 **/
            $this->addElement(array ( 'name' => 'photo__delete_photo', 'factory' => 'yesno', 'label' => _text('Can Delete Photo','_photo'), 'placeholder' => _text('Can Delete Photo','_photo'), 'info' => _text('Can Delete Photo [Info]', '_photo'), 'value' => '1', 'required' => true, ));        
        
            /** element `photo__limit_photo` id=3445 **/
            $this->addElement(array ( 'name' => 'photo__limit_photo', 'factory' => 'text', 'label' => _text('Limit Photo','_photo'), 'placeholder' => _text('Limit Photo','_photo'), 'info' => _text('Limit Photo [Info]', '_photo'), 'value' => '0', 'required' => true, ));        
        
            /** element `photo__limit_album` id=3446 **/
            $this->addElement(array ( 'name' => 'photo__limit_album', 'factory' => 'text', 'label' => _text('Limit Album','_photo'), 'placeholder' => _text('Limit Album','_photo'), 'info' => _text('Limit Album [Info]', '_photo'), 'value' => '0', 'required' => true, ));        
        
            /** element `photo__approval` id=3447 **/
            $this->addElement(array ( 'name' => 'photo__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_photo'), 'placeholder' => _text('Approval Process','_photo'), 'info' => _text('Approval Process [Info]', '_photo'), 'value' => '0', 'required' => true, ));        
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
