<?php

namespace Neutron\Core\Form\Admin\I18nLocale;

use Phpfox\Form\Form;

class EditI18nLocale extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Locale', ''));
        $this->setInfo(_text('[Edit Locale Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `locale_id`
        $this->addElement([
            'name'      => 'locale_id',
            'factory'   => 'select',
            'label'     => _text('Locale Id', null),
            'note'      => _text('[Locale Id Note]', null),
            'options'   => _service('core.i18n')->getLocaleIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `name`
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('Name', null),
            'note'      => _text('[Name Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `native_name`
        $this->addElement([
            'name'      => 'native_name',
            'factory'   => 'text',
            'label'     => _text('Native Name', null),
            'note'      => _text('[Native Name Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `code_6391`
        $this->addElement([
            'name'      => 'code_6391',
            'factory'   => 'text',
            'label'     => _text('Code 6391', null),
            'note'      => _text('[Code 6391 Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `direction_id`
        $this->addElement([
            'name'      => 'direction_id',
            'factory'   => 'select',
            'label'     => _text('Direction Id', null),
            'note'      => _text('[Direction Id Note]', null),
            'value'     => 'ltr',
            'options'   => _service('core.i18n')->getDirectionIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', null),
            'note'     => _text('[Is Active Note]', null),
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
