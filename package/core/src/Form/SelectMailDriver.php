<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;

class SelectMailDriver extends Form
{
    protected function initialize()
    {
        $this->setAttribute('method', 'get');

        $this->addElement([
            'factory'    => 'radio',
            'name'       => 'driver_id',
            'label'      => _text('Select Driver'),
            'required'   => true,
            'value'      => 'smtp',
            'options'    => \Phpfox::get('core.mails')->getDriverIdOptions(),
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Continue') . ' <i class="fa fa-arrow-right"></i>',
                'attributes' => ['class' => 'btn btn-info'],
            ]),
        ];
    }
}