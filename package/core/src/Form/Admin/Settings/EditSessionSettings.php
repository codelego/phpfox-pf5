<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSessionSettings extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Core Session', 'admin.core_session_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__cookie_path` **/
        $this->addElement([
            'name'     => 'core__cookie_path',
            'factory'  => 'text',
            'label'    => _text('Cookie Path', 'admin.core_session_setting'),
            'info'     => _text('[Cookie Path Info]', 'admin.core_session_setting'),
            'value'    => '/',
            'required' => '1',
        ]);

        /** element `core__cookie_domain` **/
        $this->addElement([
            'name'    => 'core__cookie_domain',
            'factory' => 'text',
            'label'   => _text('Cookie Domain', 'admin.core_session_setting'),
            'info'    => _text('[Cookie Domain Info]', 'admin.core_session_setting'),
        ]);

        /** element `core__http_only` **/
        $this->addElement([
            'name'     => 'core__http_only',
            'factory'  => 'yesno',
            'label'    => _text('Http Only', 'admin.core_session_setting'),
            'info'     => _text('[Http Only Info]', 'admin.core_session_setting'),
            'value'    => '0',
            'required' => '1',
        ]);

        /** element `core__session_type` **/
        $this->addElement([
            'name'     => 'core__session_type',
            'factory'  => 'select',
            'label'    => _text('Session Type', 'admin.core_session_setting'),
            'info'     => _text('[Session Type Info]', 'admin.core_session_setting'),
            'value'    => 'files',
            'options'  => _get('core.adapter')->getAdapterIdOptions('session'),
            'required' => '1',
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
