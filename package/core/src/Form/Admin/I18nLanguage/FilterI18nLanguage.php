<?php

namespace Neutron\Core\Form\Admin\I18nLanguage;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterI18nLanguage extends Form
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


        // element `language_id`
        $this->addElement([
            'name'       => 'language_id',
            'factory'    => 'select',
            'label'      => _text('Language', 'admin.i18n'),
            'options'    => _service('core.language')->getLanguageIdOptions(),
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

        // element `native_name`
        $this->addElement([
            'name'       => 'native_name',
            'factory'    => 'text',
            'label'      => _text('Native Name', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `code_6391`
        $this->addElement([
            'name'       => 'code_6391',
            'factory'    => 'text',
            'label'      => _text('Code 6391', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `direction_id`
        $this->addElement([
            'name'       => 'direction_id',
            'factory'    => 'select',
            'label'      => _text('Direction', 'admin.i18n'),
            'options'    => _service('core.language')->getDirectionIdOptions(),
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
        // skip element `is_default` #skips

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
