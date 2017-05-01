<?php

namespace Neutron\Core\Form;

use Phpfox\Form\Button;
use Phpfox\Form\Form;

class AddNewPhrase extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'    => 'text',
                'label'      => 'Key',
                'name'       => 'var_name',
                'attributes' => ['class' => 'form-control'],
            ],
            [
                'factory'    => 'textarea',
                'label'      => 'Translation',
                'name'       => 'text_value',
                'attributes' => ['class' => 'form-control'],
            ],
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ])
        ];
    }
}