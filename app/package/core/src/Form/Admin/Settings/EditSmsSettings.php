<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSmsSettings extends Form
{

    /** id=672 */
    public function initialize()
    {

        $this->setTitle(_text('Edit SMS Service Settings', '_core.sms'));
        $this->setInfo(_text('Edit SMS Service Settings [Info]', '_core.sms'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_sms_id` id=2191 **/
        $this->addElement(['name'        => 'core__default_sms_id',
                           'factory'     => 'select',
                           'label'       => _text('Default SMS Service', '_core.sms'),
                           'placeholder' => _text('Default SMS Service', '_core.sms'),
                           'info'        => _text('Default SMS Id [Info]', '_core.sms'),
                           'options'     => \Phpfox::get('core.adapter')->getAdapterIdOptions('sms'),
                           'required'    => true,
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
            'href'       => _url('admin.core.sms'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
