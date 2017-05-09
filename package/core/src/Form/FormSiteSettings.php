<?php

namespace Neutron\Core\Form;


use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class FormSiteSettings extends Form
{
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