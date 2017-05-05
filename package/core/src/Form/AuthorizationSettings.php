<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AuthorizationSettings extends Form
{
    public function getStorageLimitOptions()
    {
        if (file_exists($filename = PHPFOX_CONFIG_DIR . 'storage_limit.php')) {
            return include $filename;
        }

        return [
            ['value' => 0, 'label' => _text('Unlimited')],
            ['value' => 5242880, 'label' => '5Mb'],
            ['value' => 10485760, 'label' => '25Mb'],
            ['value' => 52428800, 'label' => '50Mb'],
            ['value' => 104857600, 'label' => '100Mb'],
            ['value' => 524288000, 'label' => '500Mb'],
            ['value' => 1073741824, 'label' => '1Gb'],
            ['value' => 2147483648, 'label' => '2Gb'],
            ['value' => 5368709120, 'label' => '5Gb'],
            ['value' => 10737418240, 'label' => '10Gb'],
            ['value' => 26843545600, 'label' => '25Gb'],
        ];
    }

    protected function initialize()
    {

        $this->addElements([
            [
                'factory' => 'choice',
                'name'    => 'core__account_deletion',
                'label'   => _text('Allow Account Deletion?', 'admin'),
                'note'    => 'Allow members to delete their account',
                'render'  => 'radio',
                'value'   => 1,
                'options' => [
                    [
                        'value' => 1,
                        'label' => _text('Yes, allow members to delete their account',
                            'admin'),
                    ],
                    [
                        'value' => 0,
                        'label' => _text('No, do not allow account deletion',
                            'admin'),
                    ],
                ],
            ],
            [
                'factory' => 'choice',
                'name'    => 'core__blocking',
                'note'    => _text('[allow blocking note]', 'admin'),
                'label'   => _text('Allow Blocking?', 'admin'),
                'render'  => 'yesno',
                'value'   => 1,
            ],
            [
                'factory'    => 'choice',
                'render'     => 'select',
                'value'      => 0,
                'name'       => 'core__storage_quota',
                'label'      => _text('Storage Quota?', 'admin'),
                'attributes' => ['class' => 'form-control'],
                'required'   => true,
                'note'       => _text('[storage quota note]', 'admin'),
                'options'    => $this->getStorageLimitOptions(),
            ],
        ]);

        _emit('onAuthorizationSettingsFormInit', $this);
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