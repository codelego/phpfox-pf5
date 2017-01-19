<?php

namespace Neutron\Core\Form;

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
}