<?php

namespace Neutron\Core\Form;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddLayoutBlock extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'  => 'radio',
            'name'     => 'component_id',
            'label'    => _text('Component'),
            'required' => true,
            'options'  => _service('layout_loader')->getComponentIdOptions(),
        ]);
    }

    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
            ]),
            new ButtonField([
                'name'       => 'cancel',
                'href'       => '#',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
