<?php
namespace Neutron\Video\Form\Admin\Video;

use Phpfox\Form\Form;

class EditVideo extends Form {

    /** id=225 */
    public function initialize(){

        $this->setTitle(_text('Edit Video','_video'));
        $this->setInfo(_text('Edit Video [Form Info]','_video'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3290 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_video'), 'placeholder' => _text('Is Active','_video'), 'info' => _text('Is Active [Info]', '_video'), 'value' => '1', 'required' => true, ));        
        
            /** element `is_approval` id=3291 **/
            $this->addElement(array ( 'name' => 'is_approval', 'factory' => 'yesno', 'label' => _text('Is Approval','_video'), 'placeholder' => _text('Is Approval','_video'), 'info' => _text('Is Approval [Info]', '_video'), 'value' => '1', 'required' => true, ));        
        
            /** element `channel_id` id=3329 **/
            $this->addElement(array ( 'name' => 'channel_id', 'factory' => 'text', 'label' => _text('Channel Id','_video'), 'placeholder' => _text('Channel Id','_video'), 'info' => _text('Channel Id [Info]', '_video'), 'value' => '0', 'required' => true, ));        
        
            /** element `category_id` id=3292 **/
            $this->addElement(array ( 'name' => 'category_id', 'factory' => 'text', 'label' => _text('Category Id','_video'), 'placeholder' => _text('Category Id','_video'), 'info' => _text('Category Id [Info]', '_video'), 'value' => '0', 'required' => true, ));        
        
            /** element `provider_id` id=3293 **/
            $this->addElement(array ( 'name' => 'provider_id', 'factory' => 'text', 'label' => _text('Provider Id','_video'), 'placeholder' => _text('Provider Id','_video'), 'info' => _text('Provider Id [Info]', '_video'), 'required' => true, ));        
        
            /** element `params` id=3331 **/
            $this->addElement(array ( 'name' => 'params', 'factory' => 'textarea', 'label' => _text('Params','_video'), 'placeholder' => _text('Params','_video'), 'info' => _text('Params [Info]', '_video'), ));        
        
            /** element `title` id=3294 **/
            $this->addElement(array ( 'name' => 'title', 'factory' => 'text', 'label' => _text('Title','_video'), 'placeholder' => _text('Title','_video'), 'info' => _text('Title [Info]', '_video'), 'required' => true, ));        
        
            /** element `description` id=3301 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description','_video'), 'placeholder' => _text('Description','_video'), 'info' => _text('Description [Info]', '_video'), ));        
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
