<?php

namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FilterI18nMessage extends Form
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

        // skip element `message_id` #identity

        // element `package_id`
        $this->addElement([
            'name'       => 'package_id',
            'factory'    => 'select',
            'label'      => _text('Package', 'admin.i18n'),
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

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

        // element `domain_id`
        $this->addElement([
            'name'       => 'domain_id',
            'factory'    => 'text',
            'label'      => _text('Domain', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `message_name`
        $this->addElement([
            'name'       => 'message_name',
            'factory'    => 'text',
            'label'      => _text('Message Name', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);

        // element `message_value`
        $this->addElement([
            'name'       => 'message_value',
            'factory'    => 'text',
            'label'      => _text('Message Value', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
        ]);
        // skip element `is_json` #skips
        // skip element `is_updated` #skips

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
