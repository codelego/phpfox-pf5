<?php

namespace Neutron\Video\Form\Admin\VideoEncoder;

use Phpfox\Form\Form;

class EditZenCoderSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle('Edit Zencoder  Settings');
        $this->setInfo('Edit Zencoder Settings');

        $this->addElement([
            'name'        => 'video__zencoder_api_key',
            'factory'     => 'text',
            'label'       => _text('Zencoder API Key', '_video'),
            'placeholder' => _text('Zencoder API Key', '_video'),
            'info'        => _text('Zencoder API Key [Info]', '_video'),
            'required'    => true,
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
            'href'       => _url('admin.video.encoder'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}