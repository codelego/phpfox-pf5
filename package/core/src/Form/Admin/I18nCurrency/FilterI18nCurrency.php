<?php

namespace Neutron\Core\Form\Admin\I18nCurrency;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterI18nCurrency extends Form
{

    public function initialize()
    {

        $this->setMethod('get');

        $this->addElement([
            'factory'    => 'text',
            'name'       => 'q',
            'label'      => _text('Search', 'admin'),
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => _text('Search', 'admin'),
            ],
        ]);

        /** start elements **/


        // element `currency_id`
        $this->addElement([
            'name'       => 'currency_id',
            'factory'    => 'text',
            'label'      => _text('Currency', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `symbol`
        $this->addElement([
            'name'       => 'symbol',
            'factory'    => 'text',
            'label'      => _text('Symbol', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `name`
        $this->addElement([
            'name'       => 'name',
            'factory'    => 'text',
            'label'      => _text('Name', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `sort_order`
        $this->addElement([
            'name'       => 'sort_order',
            'factory'    => 'text',
            'label'      => _text('Sort Order', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);
        // skip element `is_default` #skips

        // element `is_active`
        $this->addElement([
            'name'       => 'is_active',
            'factory'    => 'select',
            'label'      => _text('Is Active', 'admin.i18n'),
            'options'    =>
                [
                    0 =>
                        [
                            'value' => 1,
                            'label' => 'Yes',
                        ],
                    1 =>
                        [
                            'value' => 0,
                            'label' => 'No',
                        ],
                ],
            'attributes' =>
                [
                    'class' => 'form-control',
                ],
        ]);

        /** end elements **/
    }

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd'=>'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
