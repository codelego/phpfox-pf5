<?php
namespace Neutron\Video\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditVideoPermissions extends Form {

    /** id=814 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_video'));
        $this->setInfo(_text('[Edit Permissions Info]','_video'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `video__add_video` id=3458 **/
            $this->addElement(array ( 'name' => 'video__add_video', 'factory' => 'yesno', 'label' => _text('Can Add Video','_video'), 'placeholder' => _text('Can Add Video','_video'), 'info' => _text('Can Add Video [Info]', '_video'), 'required' => true, ));        
        
            /** element `video__edit_video` id=3459 **/
            $this->addElement(array ( 'name' => 'video__edit_video', 'factory' => 'yesno', 'label' => _text('Can Edit Video','_video'), 'placeholder' => _text('Can Edit Video','_video'), 'info' => _text('Can Edit Video [Info]', '_video'), 'required' => true, ));        
        
            /** element `video__delete_video` id=3460 **/
            $this->addElement(array ( 'name' => 'video__delete_video', 'factory' => 'yesno', 'label' => _text('Can Delete Video','_video'), 'placeholder' => _text('Can Delete Video','_video'), 'info' => _text('Can Delete Video [Info]', '_video'), 'required' => true, ));        
        
            /** element `video__limit_video` id=3461 **/
            $this->addElement(array ( 'name' => 'video__limit_video', 'factory' => 'text', 'label' => _text('Limit Video','_video'), 'placeholder' => _text('Limit Video','_video'), 'info' => _text('Limit Video [Info]', '_video'), 'value' => '0', 'required' => true, ));        
        
            /** element `video__approval` id=3462 **/
            $this->addElement(array ( 'name' => 'video__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_video'), 'placeholder' => _text('Approval Process','_video'), 'info' => _text('Approval Process [Info]', '_video'), 'required' => true, ));        
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
