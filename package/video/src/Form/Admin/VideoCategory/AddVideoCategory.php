<?php
namespace Neutron\Video\Form\Admin\VideoCategory;

use Phpfox\Form\Form;

class AddVideoCategory extends Form {

    /** id=116 */
    public function initialize(){

        $this->setTitle(_text('Add Video Category','_video'));
        $this->setInfo(_text('Add Video Category [Form Info]','_video'));
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `is_active` id=3269 **/
            $this->addElement(array ( 'name' => 'is_active', 'factory' => 'yesno', 'label' => _text('Is Active','_video'), 'placeholder' => _text('Is Active','_video'), 'info' => _text('Is Active [Info]', '_video'), 'value' => '1', 'required' => true, ));        
        
            /** element `name` id=3270 **/
            $this->addElement(array ( 'name' => 'name', 'factory' => 'text', 'label' => _text('Name','_video'), 'placeholder' => _text('Name','_video'), 'info' => _text('Name [Info]', '_video'), 'required' => true, ));        
        
            /** element `description` id=3271 **/
            $this->addElement(array ( 'name' => 'description', 'factory' => 'textarea', 'label' => _text('Description','_video'), 'placeholder' => _text('Description','_video'), 'info' => _text('Description [Info]', '_video'), ));        
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
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
