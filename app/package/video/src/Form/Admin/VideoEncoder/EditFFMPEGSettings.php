<?php

namespace Neutron\Video\Form\Admin\VideoEncoder;

use Phpfox\Form\Form;

class EditFFMPEGSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle('Edit FFMPEG  Settings');
        $this->setInfo('Edit FFMPEG Settings');


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