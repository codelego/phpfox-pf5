<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddLayoutBlock extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'radio',
            'name'       => 'component_id',
            'attributes' => ['class' => 'form-control',],
            'label'      => _text('Component'),
            'required'   => true,
            'options'    => _get('layout_loader')->getComponentIdOptions(),
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
