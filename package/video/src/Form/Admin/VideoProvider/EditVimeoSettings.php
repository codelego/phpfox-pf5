<?php

namespace Neutron\Video\Form\Admin\VideoProvider;

use Phpfox\Form\Form;

class EditVimeoSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle('Edit Vimeo Settings');
        $this->setInfo('Edit Vimeo Settings');

        $this->addElement([
            'factory'     => 'text',
            'label'       => 'Vimeo Api Key',
            'placeholder' => 'Key',
            'required'    => true,
            'info'        => 'Facebook Api Key',
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.video.provider'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}