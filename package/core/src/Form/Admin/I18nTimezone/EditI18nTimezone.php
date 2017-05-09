<?php

namespace Neutron\Core\Form\Admin\I18nTimezone;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditI18nTimezone extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Timezone', 'admin.i18n'));
        $this->setInfo(_text('[Edit Timezone Info]', 'admin.i18n'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `timezone_id`
        $this->addElement([
            'name'       => 'timezone_id',
            'factory'    => 'text',
            'label'      => _text('Timezone', 'admin.i18n'),
            'note'       => _text('[Timezone Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `timezone_location`
        $this->addElement([
            'name'       => 'timezone_location',
            'factory'    => 'text',
            'label'      => _text('Timezone Location', 'admin.i18n'),
            'note'       => _text('[Timezone Location Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', 'admin.i18n'),
            'note'     => _text('[Is Active Note]', 'admin.i18n'),
            'value'    => '1',
            'required' => true,
        ]);

        // element `sort_order`
        $this->addElement([
            'name'       => 'sort_order',
            'factory'    => 'text',
            'label'      => _text('Sort Order', 'admin.i18n'),
            'note'       => _text('[Sort Order Note]', 'admin.i18n'),
            'value'      => '0',
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `timezone_code`
        $this->addElement([
            'name'       => 'timezone_code',
            'factory'    => 'text',
            'label'      => _text('Timezone Code', 'admin.i18n'),
            'note'       => _text('[Timezone Code Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `timezone_offset`
        $this->addElement([
            'name'       => 'timezone_offset',
            'factory'    => 'text',
            'label'      => _text('Timezone Offset', 'admin.i18n'),
            'note'       => _text('[Timezone Offset Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
