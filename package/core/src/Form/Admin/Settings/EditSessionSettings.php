<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditSessionSettings extends Form
{

    /** id=677 */
    public function initialize()
    {

        $this->setTitle(_text('Edit Session Settings', '_core.session_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_session_id` id=2142 **/
        $this->addElement([
            'name'     => 'core__default_session_id',
            'factory'  => 'select',
            'label'    => _text('Default Session', '_core.session_settings'),
            'info'     => _text('[Default Session Id Info]', '_core.session_settings'),
            'options'  => _get('core.adapter')->getAdapterIdOptions('session'),
            'required' => true,
        ]);

        /** element `core__session_name` id=2143 **/
        $this->addElement([
            'name'      => 'core__session_name',
            'factory'   => 'text',
            'label'     => _text('Session Name', '_core.session_settings'),
            'info'      => _text('[Session Name Info]', '_core.session_settings'),
            'maxlength' => '16',
            'required'  => true,
        ]);

        /** element `core__cookie_domain` id=1952 **/
        $this->addElement([
            'name'    => 'core__cookie_domain',
            'factory' => 'text',
            'label'   => _text('Cookie Domain', '_core.session_settings'),
            'note'    => _text('[experience_only]', '_core'),
            'info'    => _text('[Cookie Domain Info]', '_core.session_settings'),
        ]);

        /** element `core__cookie_path` id=1951 **/
        $this->addElement([
            'name'     => 'core__cookie_path',
            'factory'  => 'text',
            'label'    => _text('Cookie Path', '_core.session_settings'),
            'note'     => _text('[experience_only]', '_core'),
            'info'     => _text('[Cookie Path Info]', '_core.session_settings'),
            'value'    => '/',
            'required' => true,
        ]);

        /** element `core__cookie_secure` id=2141 **/
        $this->addElement([
            'name'     => 'core__cookie_secure',
            'factory'  => 'yesno',
            'label'    => _text('Cookie Secure', '_core.session_settings'),
            'note'     => _text('[experience_only]', '_core'),
            'info'     => _text('[Cookie Secure Info]', '_core.session_settings'),
            'required' => true,
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
