<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditI18nSettings extends Form
{

    /** id=666 */
    public function initialize()
    {

        $this->setTitle(_text('Edit International Settings', '_core.i18n_settings'));
        $this->setInfo(_text('[Edit Site Settings Info]', '_core'));
        $this->setMethod('post');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__default_locale_id` id=2174 **/
        $this->addElement([
            'name'     => 'core__default_locale_id',
            'factory'  => 'select',
            'label'    => _text('Default Locale', '_core.i18n_settings'),
            'info'     => _text('[Default Locale Id Info]', '_core.i18n_settings'),
            'required' => true,
        ]);

        /** element `core__default_timezone_id` id=2175 **/
        $this->addElement([
            'name'     => 'core__default_timezone_id',
            'factory'  => 'select',
            'label'    => _text('Default Timezone', '_core.i18n_settings'),
            'info'     => _text('[Default Timezone Id Info]', '_core.i18n_settings'),
            'required' => true,
        ]);

        /** element `core__default_currency_id` id=2176 **/
        $this->addElement([
            'name'     => 'core__default_currency_id',
            'factory'  => 'select',
            'label'    => _text('Default Currency', '_core.i18n_settings'),
            'info'     => _text('[Default Currency Id Info]', '_core.i18n_settings'),
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
