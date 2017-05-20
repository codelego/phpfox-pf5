<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditMailSettings extends Form {

    /** id=669 */
    public function initialize(){

        $this->setTitle(_text('Edit Mail Settings', '_core.mail_settings'));
        $this->setInfo(_text('Edit Site Settings [Info]', '_core'));
        $this->setMethod('post');                 $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__default_mailer_id` id=2177 **/
            $this->addElement(array ( 'name' => 'core__default_mailer_id', 'factory' => 'select', 'label' => _text('Default Mail','_core.mail_settings'), 'info' => _text('Default Mail Id [Info]', '_core.mail_settings'), 'required' => true, ));        
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
