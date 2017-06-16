<?php
namespace Neutron\Pages\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditPagesSettings extends Form {

    /** id=803 */
    public function initialize(){

        $this->setTitle(_text('Edit Pages', 'admin.pages_setting'));
        $this->setInfo(_text('Edit Pages [Info]', 'admin.pages_setting'));
        $this->setMethod('post');         $this->setEncType('');         $this->setAction(_url('#'));

        /** start elements **/

        
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
