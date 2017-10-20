<?php

namespace Neutron\Video\Form\Admin\VideoProvider;

use Phpfox\Form\Form;

class EditEmbedLinkSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle('Edit EmbedLink Settings');
        $this->setInfo('Edit EmbedLink Settings');

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