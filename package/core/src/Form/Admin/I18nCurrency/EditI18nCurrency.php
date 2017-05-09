<?php

namespace Neutron\Core\Form\Admin\I18nCurrency;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditI18nCurrency extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Currency', 'admin.i18n'));
        $this->setInfo(_text('[Edit Currency Info]', 'admin.i18n'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `currency_id`
        $this->addElement([
            'name'       => 'currency_id',
            'factory'    => 'text',
            'label'      => _text('Currency', 'admin.i18n'),
            'note'       => _text('[Currency Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `symbol`
        $this->addElement([
            'name'       => 'symbol',
            'factory'    => 'text',
            'label'      => _text('Symbol', 'admin.i18n'),
            'note'       => _text('[Symbol Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `name`
        $this->addElement([
            'name'       => 'name',
            'factory'    => 'text',
            'label'      => _text('Name', 'admin.i18n'),
            'note'       => _text('[Name Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
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
        // skip element `is_default` #skips

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', 'admin.i18n'),
            'note'     => _text('[Is Active Note]', 'admin.i18n'),
            'value'    => '0',
            'required' => true,
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
