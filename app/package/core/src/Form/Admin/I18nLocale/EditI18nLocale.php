<?php

namespace Neutron\Core\Form\Admin\I18nLocale;

use Phpfox\Form\Form;

class EditI18nLocale extends Form
{
    /** lock */
    public function initialize()
    {

        $this->setTitle(_text('Edit Locale', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `locale_id` **/
        $this->addElement([
            'name'      => 'locale_id',
            'factory'   => 'text',
            'label'     => _text('Locale Id', '_core.i18n_locale'),
            'options'   => \Phpfox::get('core.i18n')->getLocaleIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `name` **/
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('English Name', '_core.i18n_locale'),
            'info'      => _text('English Name [Info]', '_core.i18n_locale'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `native_name` **/
        $this->addElement([
            'name'      => 'native_name',
            'factory'   => 'text',
            'label'     => _text('Native Name', '_core.i18n_locale'),
            'info'      => _text('Native Name [Info]', '_core.i18n_locale'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `code_6391` **/
        $this->addElement([
            'name'      => 'code_6391',
            'factory'   => 'text',
            'label'     => _text('Code 6391', '_core.i18n_locale'),
            'info'      => _text('Code 6391 [Info]', '_core.i18n_locale'),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `direction_id` **/
        $this->addElement([
            'name'      => 'direction_id',
            'factory'   => 'radio',
            'inline'    => true,
            'label'     => _text('Direction Id', '_core.i18n_locale'),
            'value'     => 'ltr',
            'options'   => \Phpfox::get('core.i18n')->getDirectionIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `is_active` **/
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', '_core.i18n_locale'),
            'info'     => _text('Is Active [Info]', '_core.i18n_locale'),
            'value'    => '1',
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}
