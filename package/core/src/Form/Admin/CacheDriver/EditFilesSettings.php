<?php

namespace Neutron\Core\Form\Admin\CacheDriver;

use Phpfox\Form\Form;

class EditFilesSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('Edit Cache Settings', 'admin.core_cache'));
        $this->setInfo(_text('[Edit Cache Settings Note]', 'admin.core_cache'));

        /** end elements */

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => _url('admin.core.cache'),
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}