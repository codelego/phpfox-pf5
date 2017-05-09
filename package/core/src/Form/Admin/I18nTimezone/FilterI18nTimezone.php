<?php

namespace Neutron\Core\Form\Admin\I18nTimezone;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterI18nTimezone extends Form
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


        // element `timezone_id`
        $this->addElement([
            'name'       => 'timezone_id',
            'factory'    => 'text',
            'label'      => _text('Timezone', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `timezone_location`
        $this->addElement([
            'name'       => 'timezone_location',
            'factory'    => 'text',
            'label'      => _text('Timezone Location', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

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

        // element `timezone_code`
        $this->addElement([
            'name'       => 'timezone_code',
            'factory'    => 'text',
            'label'      => _text('Timezone Code', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `timezone_offset`
        $this->addElement([
            'name'       => 'timezone_offset',
            'factory'    => 'text',
            'label'      => _text('Timezone Offset', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        /** end elements **/
    }

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'search',
                'label'      => _text('Search'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
        /** end buttons **/
    }
}
