<?php

namespace Neutron\Core\Form\Admin\I18nLocale;

use Phpfox\Form\Form;

class FilterI18nLocale extends Form
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


        // element `locale_id`
        $this->addElement([
            'name'      => 'locale_id',
            'factory'   => 'select',
            'label'     => _text('Locale', null),
            'options'   => _service('core.i18n')->getLocaleIdOptions(),
            'maxlength' => 255,
        ]);

        // element `name`
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('Name', null),
            'maxlength' => 255,
        ]);

        // element `native_name`
        $this->addElement([
            'name'      => 'native_name',
            'factory'   => 'text',
            'label'     => _text('Native Name', null),
            'maxlength' => 255,
        ]);

        // element `code_6391`
        $this->addElement([
            'name'      => 'code_6391',
            'factory'   => 'text',
            'label'     => _text('Code 6391', null),
            'maxlength' => 255,
        ]);

        // element `direction_id`
        $this->addElement([
            'name'      => 'direction_id',
            'factory'   => 'select',
            'label'     => _text('Direction', null),
            'options'   => _service('core.i18n')->getDirectionIdOptions(),
            'maxlength' => 255,
        ]);

        // element `is_active`
        $this->addElement([
            'name'    => 'is_active',
            'factory' => 'select',
            'label'   => _text('Is Active', null),
            'options' =>
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
        ]);

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        /** end elements **/
    }
}
