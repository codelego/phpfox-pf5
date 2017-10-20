<?php
namespace Neutron\Video\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditVideoSettings extends Form {

    /** id=789 */
    public function initialize(){

        $this->setTitle(_text('Edit Video Settings', '_video'));
        $this->setInfo(_text('Edit Video Settings [Info]', '_video'));
        $this->setMethod('post');         $this->setEncType('');         $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `video__allow_embed` id=3378 **/
            $this->addElement(array ( 'name' => 'video__allow_embed', 'factory' => 'yesno', 'label' => _text('Allow Embed','_video'), 'placeholder' => _text('Allow Embed','_video'), 'info' => _text('Allow Embed [Info]', '_video'), 'required' => true, ));        
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
