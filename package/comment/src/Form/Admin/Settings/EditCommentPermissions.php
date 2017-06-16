<?php
namespace Neutron\Comment\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditCommentPermissions extends Form {

    /** id=808 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_comment'));
        $this->setInfo(_text('[Edit Permissions Info]','_comment'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `comment__add_comment` id=3426 **/
            $this->addElement(array ( 'name' => 'comment__add_comment', 'factory' => 'yesno', 'label' => _text('Can Add Comment','_comment'), 'placeholder' => _text('Can Add Comment','_comment'), 'info' => _text('Can Add Comment [Info]', '_comment'), 'required' => true, ));        
        
            /** element `comment__edit_comment` id=3427 **/
            $this->addElement(array ( 'name' => 'comment__edit_comment', 'factory' => 'yesno', 'label' => _text('Can Edit Comment','_comment'), 'placeholder' => _text('Can Edit Comment','_comment'), 'info' => _text('Can Edit Comment [Info]', '_comment'), 'required' => true, ));        
        
            /** element `comment__delete_comment` id=3428 **/
            $this->addElement(array ( 'name' => 'comment__delete_comment', 'factory' => 'yesno', 'label' => _text('Can Delete Comment','_comment'), 'placeholder' => _text('Can Delete Comment','_comment'), 'info' => _text('Can Delete Comment [Info]', '_comment'), 'required' => true, ));        
        
            /** element `comment__approval` id=3429 **/
            $this->addElement(array ( 'name' => 'comment__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_comment'), 'placeholder' => _text('Approval Process','_comment'), 'info' => _text('Approval Process [Info]', '_comment'), 'required' => true, ));        
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
