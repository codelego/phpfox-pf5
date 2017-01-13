<?php

namespace Neutron\Core\Form;


use Phpfox\Form\Form;

class MaintenanceSettings extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'    => 'choice',
                'render'     => 'radio',
                'name'       => 'mode',
                'label'      => _text('Maintenance'),
                'attributes' => ['class' => 'form-control'],
                'value'      => 'online',
                'options'    => [
                    ['label' => 'Offline', 'value' => 'offline',],
                    ['label' => 'Online', 'value' => 'online',],
                ],
            ],

        ]);
    }
}