<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

/** lock */
class EditCaptchaSettings extends Form
{

    /** id=665 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Captcha Settings', '_core.captcha'));
        $this->setInfo(_text('[Edit Captcha Settings Info]', '_core.captcha'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_captcha_id` id=1946 **/
        $this->addElement([
            'name'     => 'core__default_captcha_id',
            'factory'  => 'select',
            'required' => 1,
            'label'    => _text('Default Captcha', '_core.captcha'),
            'info'     => _text('[Default Captcha Id Info]', '_core.captcha'),
            'options'  => \Phpfox::get('core.adapter')->getAdapterIdOptions('captcha'),
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
            'href'       => _url('admin.core.captcha'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
