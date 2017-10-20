<?php
namespace Neutron\Poll\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditPollSettings extends Form {

    /** id=804 */
    public function initialize(){

        $this->setTitle(_text('Edit Poll', 'admin.poll_setting'));
        $this->setInfo(_text('Edit Poll [Info]', 'admin.poll_setting'));
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
