<?php

namespace Neutron\User\Form\Admin\Settings;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class UserLoginSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('User Registration Settings', 'user_login'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));
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