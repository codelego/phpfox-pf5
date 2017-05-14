<?php
namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditCaptchaSettings extends Form {

    public function initialize(){

        $this->setTitle(_text('Edit Core Captcha', 'admin.core_captcha_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/

        
        
            /** element `core__default_captcha_id` **/
            $this->addElement(array ( 'name' => 'core__default_captcha_id', 'factory' => 'select', 'label' => _text('Default Captcha','admin.core_captcha_setting'), 'info' => _text('[Default Captcha Id Info]', 'admin.core_captcha_setting'), ));        
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}
