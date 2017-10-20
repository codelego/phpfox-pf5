<?php

namespace Neutron\Video\Form;

use Phpfox\Form\Form;

class EmbedVideo extends Form
{
    protected function initialize()
    {
        $this->addElements([
            [
                'factory'  => 'text',
                'name'     => 'origin_url',
                'label'    => _text('Video Url', 'video'),
                'required' => true,
            ],
        ]);
    }
}