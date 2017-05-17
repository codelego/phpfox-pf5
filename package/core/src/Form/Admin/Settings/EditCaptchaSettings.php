<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditCaptchaSettings extends Form
{

    /** id=665 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Captcha Settings', '_core.captcha_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_captcha_id` id=1946 **/
        $this->addElement([
            'name'    => 'core__default_captcha_id',
            'factory' => 'select',
            'label'   => _text('Default Captcha', '_core.captcha_settings'),
            'info'    => _text('[Default Captcha Id Info]', '_core.captcha_settings'),
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('#'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
