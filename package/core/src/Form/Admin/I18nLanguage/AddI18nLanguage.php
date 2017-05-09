<?php

namespace Neutron\Core\Form\Admin\I18nLanguage;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddI18nLanguage extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Language', 'admin.i18n'));
        $this->setInfo(_text('[Add Language Info]', 'admin.i18n'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `language_id`
        $this->addElement([
            'name'       => 'language_id',
            'factory'    => 'select',
            'label'      => _text('Language', 'admin.i18n'),
            'note'       => _text('[Language Note]', 'admin.i18n'),
            'options'    => _service('core.language')->getLanguageIdOptions(),
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

        // element `native_name`
        $this->addElement([
            'name'       => 'native_name',
            'factory'    => 'text',
            'label'      => _text('Native Name', 'admin.i18n'),
            'note'       => _text('[Native Name Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
        ]);

        // element `code_6391`
        $this->addElement([
            'name'       => 'code_6391',
            'factory'    => 'text',
            'label'      => _text('Code 6391', 'admin.i18n'),
            'note'       => _text('[Code 6391 Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `direction_id`
        $this->addElement([
            'name'       => 'direction_id',
            'factory'    => 'select',
            'label'      => _text('Direction', 'admin.i18n'),
            'note'       => _text('[Direction Note]', 'admin.i18n'),
            'value'      => 'ltr',
            'options'    => _service('core.language')->getDirectionIdOptions(),
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
        // skip element `is_default` #skips

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
