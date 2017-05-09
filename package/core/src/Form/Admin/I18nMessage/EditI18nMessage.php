<?php

namespace Neutron\Core\Form\Admin\I18nMessage;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class EditI18nMessage extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Message', 'admin.i18n'));
        $this->setInfo(_text('[Edit Message Info]', 'admin.i18n'));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `message_id` #identity

        // element `package_id`
        $this->addElement([
            'name'       => 'package_id',
            'factory'    => 'select',
            'label'      => _text('Package', 'admin.i18n'),
            'note'       => _text('[Package Note]', 'admin.i18n'),
            'value'      => 'core',
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

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

        // element `domain_id`
        $this->addElement([
            'name'       => 'domain_id',
            'factory'    => 'text',
            'label'      => _text('Domain', 'admin.i18n'),
            'note'       => _text('[Domain Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `message_name`
        $this->addElement([
            'name'       => 'message_name',
            'factory'    => 'text',
            'label'      => _text('Message Name', 'admin.i18n'),
            'note'       => _text('[Message Name Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `message_value`
        $this->addElement([
            'name'       => 'message_value',
            'factory'    => 'textarea',
            'label'      => _text('Message Value', 'admin.i18n'),
            'note'       => _text('[Message Value Note]', 'admin.i18n'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
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
