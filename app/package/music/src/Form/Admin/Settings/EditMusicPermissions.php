<?php
namespace Neutron\Music\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditMusicPermissions extends Form {

    /** id=815 */
    public function initialize(){

        $this->setTitle(_text('Edit Permissions','_music'));
        $this->setInfo(_text('[Edit Permissions Info]','_music'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `music__add_song` id=3463 **/
            $this->addElement(array ( 'name' => 'music__add_song', 'factory' => 'yesno', 'label' => _text('Can Add Song','_music'), 'placeholder' => _text('Can Add Song','_music'), 'info' => _text('Can Add Song [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__edit_song` id=3464 **/
            $this->addElement(array ( 'name' => 'music__edit_song', 'factory' => 'yesno', 'label' => _text('Can Edit Song','_music'), 'placeholder' => _text('Can Edit Song','_music'), 'info' => _text('Can Edit Song [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__delete_song` id=3465 **/
            $this->addElement(array ( 'name' => 'music__delete_song', 'factory' => 'yesno', 'label' => _text('Can Delete Song','_music'), 'placeholder' => _text('Can Delete Song','_music'), 'info' => _text('Can Delete Song [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__add_playlist` id=3468 **/
            $this->addElement(array ( 'name' => 'music__add_playlist', 'factory' => 'yesno', 'label' => _text('Can Add Playlist','_music'), 'placeholder' => _text('Can Add Playlist','_music'), 'info' => _text('Can Add Playlist [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__edit_playlist` id=3469 **/
            $this->addElement(array ( 'name' => 'music__edit_playlist', 'factory' => 'yesno', 'label' => _text('Can Edit Playlist','_music'), 'placeholder' => _text('Can Edit Playlist','_music'), 'info' => _text('Can Edit Playlist [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__delete_playlist` id=3470 **/
            $this->addElement(array ( 'name' => 'music__delete_playlist', 'factory' => 'yesno', 'label' => _text('Can Delete Playlist','_music'), 'placeholder' => _text('Can Delete Playlist','_music'), 'info' => _text('Can Delete Playlist [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__add_album` id=3472 **/
            $this->addElement(array ( 'name' => 'music__add_album', 'factory' => 'yesno', 'label' => _text('Can Add Album','_music'), 'placeholder' => _text('Can Add Album','_music'), 'info' => _text('Can Add Album [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__edit_album` id=3473 **/
            $this->addElement(array ( 'name' => 'music__edit_album', 'factory' => 'yesno', 'label' => _text('Can Edit Album','_music'), 'placeholder' => _text('Can Edit Album','_music'), 'info' => _text('Can Edit Album [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__delete_album` id=3474 **/
            $this->addElement(array ( 'name' => 'music__delete_album', 'factory' => 'yesno', 'label' => _text('Can Delete Album','_music'), 'placeholder' => _text('Can Delete Album','_music'), 'info' => _text('Can Delete Album [Info]', '_music'), 'value' => '1', 'required' => true, ));        
        
            /** element `music__limit_song` id=3466 **/
            $this->addElement(array ( 'name' => 'music__limit_song', 'factory' => 'text', 'label' => _text('Limit Song','_music'), 'placeholder' => _text('Limit Song','_music'), 'info' => _text('Limit Song [Info]', '_music'), 'value' => '0', 'required' => true, ));        
        
            /** element `music__limit_playlist` id=3471 **/
            $this->addElement(array ( 'name' => 'music__limit_playlist', 'factory' => 'text', 'label' => _text('Limit Playlist','_music'), 'placeholder' => _text('Limit Playlist','_music'), 'info' => _text('Limit Playlist [Info]', '_music'), 'value' => '0', 'required' => true, ));        
        
            /** element `music__limit_album` id=3475 **/
            $this->addElement(array ( 'name' => 'music__limit_album', 'factory' => 'text', 'label' => _text('Limit Album','_music'), 'placeholder' => _text('Limit Album','_music'), 'info' => _text('Limit Album [Info]', '_music'), 'value' => '0', 'required' => true, ));        
        
            /** element `music__approval` id=3467 **/
            $this->addElement(array ( 'name' => 'music__approval', 'factory' => 'yesno', 'label' => _text('Approval Process','_music'), 'placeholder' => _text('Approval Process','_music'), 'info' => _text('Approval Process [Info]', '_music'), 'value' => '0', 'required' => true, ));        
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
