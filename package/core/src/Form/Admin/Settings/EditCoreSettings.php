<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class EditCoreSettings extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Core', 'admin.core_setting'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
        $this->setEncType('multipart/form-data');
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `core__2_step_verify` **/
        $this->addElement([
            'name'    => 'core__2_step_verify',
            'factory' => 'text',
            'label'   => _text('2 Step Verify', 'admin.core_setting'),
            'info'    => _text('[2 Step Verify Info]', 'admin.core_setting'),
        ]);

        /** element `core__allow_html` **/
        $this->addElement([
            'name'    => 'core__allow_html',
            'factory' => 'text',
            'label'   => _text('Allow Html', 'admin.core_setting'),
            'info'    => _text('[Allow Html Info]', 'admin.core_setting'),
        ]);

        /** element `core__allow_html_tags` **/
        $this->addElement([
            'name'    => 'core__allow_html_tags',
            'factory' => 'text',
            'label'   => _text('Allow Html Tags', 'admin.core_setting'),
            'info'    => _text('[Allow Html Tags Info]', 'admin.core_setting'),
        ]);

        /** element `core__cookie_domain` **/
        $this->addElement([
            'name'    => 'core__cookie_domain',
            'factory' => 'text',
            'label'   => _text('Cookie Domain', 'admin.core_setting'),
            'info'    => _text('[Cookie Domain Info]', 'admin.core_setting'),
        ]);

        /** element `core__cookie_path` **/
        $this->addElement([
            'name'    => 'core__cookie_path',
            'factory' => 'text',
            'label'   => _text('Cookie Path', 'admin.core_setting'),
            'info'    => _text('[Cookie Path Info]', 'admin.core_setting'),
        ]);

        /** element `core__cookie_prefix` **/
        $this->addElement([
            'name'    => 'core__cookie_prefix',
            'factory' => 'text',
            'label'   => _text('Cookie Prefix', 'admin.core_setting'),
            'info'    => _text('[Cookie Prefix Info]', 'admin.core_setting'),
        ]);

        /** element `core__default_cache_id` **/
        $this->addElement([
            'name'    => 'core__default_cache_id',
            'factory' => 'text',
            'label'   => _text('Default Cache Id', 'admin.core_setting'),
            'info'    => _text('[Default Cache Id Info]', 'admin.core_setting'),
        ]);

        /** element `core__default_currency_id` **/
        $this->addElement([
            'name'    => 'core__default_currency_id',
            'factory' => 'text',
            'label'   => _text('Default Currency Id', 'admin.core_setting'),
            'info'    => _text('[Default Currency Id Info]', 'admin.core_setting'),
        ]);

        /** element `core__default_locale_id` **/
        $this->addElement([
            'name'    => 'core__default_locale_id',
            'factory' => 'text',
            'label'   => _text('Default Locale Id', 'admin.core_setting'),
            'info'    => _text('[Default Locale Id Info]', 'admin.core_setting'),
        ]);

        /** element `core__default_mailer_id` **/
        $this->addElement([
            'name'    => 'core__default_mailer_id',
            'factory' => 'text',
            'label'   => _text('Default Mailer Id', 'admin.core_setting'),
            'info'    => _text('[Default Mailer Id Info]', 'admin.core_setting'),
        ]);

        /** element `core__default_storage_id` **/
        $this->addElement([
            'name'    => 'core__default_storage_id',
            'factory' => 'text',
            'label'   => _text('Default Storage Id', 'admin.core_setting'),
            'info'    => _text('[Default Storage Id Info]', 'admin.core_setting'),
        ]);

        /** element `core__default_timezone_id` **/
        $this->addElement([
            'name'    => 'core__default_timezone_id',
            'factory' => 'text',
            'label'   => _text('Default Timezone Id', 'admin.core_setting'),
            'info'    => _text('[Default Timezone Id Info]', 'admin.core_setting'),
        ]);

        /** element `core__full_ajax_mode` **/
        $this->addElement([
            'name'    => 'core__full_ajax_mode',
            'factory' => 'text',
            'label'   => _text('Full Ajax Mode', 'admin.core_setting'),
            'info'    => _text('[Full Ajax Mode Info]', 'admin.core_setting'),
        ]);

        /** element `core__offline_code` **/
        $this->addElement([
            'name'    => 'core__offline_code',
            'factory' => 'text',
            'label'   => _text('Offline Code', 'admin.core_setting'),
            'info'    => _text('[Offline Code Info]', 'admin.core_setting'),
        ]);

        /** element `core__private_network` **/
        $this->addElement([
            'name'    => 'core__private_network',
            'factory' => 'text',
            'label'   => _text('Private Network', 'admin.core_setting'),
            'info'    => _text('[Private Network Info]', 'admin.core_setting'),
        ]);

        /** element `core__secure_image_enable` **/
        $this->addElement([
            'name'    => 'core__secure_image_enable',
            'factory' => 'text',
            'label'   => _text('Secure Image Enable', 'admin.core_setting'),
            'info'    => _text('[Secure Image Enable Info]', 'admin.core_setting'),
        ]);

        /** element `core__site_offline` **/
        $this->addElement([
            'name'    => 'core__site_offline',
            'factory' => 'text',
            'label'   => _text('Site Offline', 'admin.core_setting'),
            'info'    => _text('[Site Offline Info]', 'admin.core_setting'),
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
