<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class GeneralSettings extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory' => 'choice',
                'render'  => 'yesno',
                'name'    => 'core__offline',
                'value'   => 0,
                'label'   => _text('Network Offline?', 'admin'),
                'note'    => _text('[network offline]', 'admin'),
            ],
            [
                'factory' => 'choice',
                'render'  => 'yesno',
                'name'    => 'core__private_network',
                'value'   => 0,
                'label'   => _text('Private Network?', 'admin'),
                'note'    => _text('[private network]', 'admin'),
            ],
            [
                'factory'    => 'text',
                'name'       => 'core__offline_code',
                'value'      => uniqid(),
                'label'      => _text('Offline Code?', 'admin'),
                'note'       => _text('[offline code]', 'admin'),
                'attributes' => ['class' => 'form-control'],
            ],
            [
                'factory'    => 'text',
                'name'       => 'facebook__app_id',
                'label'      => _text('Facebook App ID?', 'admin'),
                'note'       => _text('[facebook app id]', 'admin'),
                'attributes' => ['class' => 'form-control'],
            ],
            [
                'factory'    => 'text',
                'name'       => 'core__ga_code',
                'label'      => _text('Google Analytics ID?', 'admin'),
                'note'       => _text('[google analytics id]', 'admin'),
                'attributes' => ['class' => 'form-control'],
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
        ];
    }
}