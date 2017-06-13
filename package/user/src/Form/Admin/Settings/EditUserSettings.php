<?php
namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditUserSettings extends Form {

    /** id=674 */
    public function initialize(){

        $this->setTitle(_text('Edit User Settings', '_user.setting_setting'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

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
            'href'       => _url('admin.user'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
