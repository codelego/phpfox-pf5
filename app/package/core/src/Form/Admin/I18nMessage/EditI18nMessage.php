<?php

namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\Form;

class EditI18nMessage extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Message', '_core.i18n_message'));
        $this->setAction(_url('#'));

        /** start elements **/


        /** skip element `message_id` #identity **/

        /** element `package_id` **/
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', '_core'),
            'value'     => 'core',
            'options'   => \Phpfox::get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `locale_id` **/
        $this->addElement([
            'name'      => 'locale_id',
            'factory'   => 'select',
            'label'     => _text('Locale Id', '_core.i18n_message'),
            'options'   => \Phpfox::get('core.i18n')->getLocaleIdOptions(),
            'maxlength' => 255,
            'required'  => false,
        ]);

        /** element `domain_id` **/
        $this->addElement([
            'name'      => 'domain_id',
            'factory'   => 'text',
            'label'     => _text('Domain Id', '_core.i18n_message'),
            'info'      => _text('Domain Id [Info]', '_core.i18n_message'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `message_name` **/
        $this->addElement([
            'name'      => 'message_name',
            'factory'   => 'text',
            'label'     => _text('Message Name', '_core.i18n_message'),
            'info'      => _text('Message Name [Info]', '_core.i18n_message'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `message_value` **/
        $this->addElement([
            'name'      => 'message_value',
            'factory'   => 'textarea',
            'label'     => _text('Message Value', '_core.i18n_message'),
            'info'      => _text('Message Value [Info]', '_core.i18n_message'),
            'maxlength' => 255,
            'required'  => false,
        ]);

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
