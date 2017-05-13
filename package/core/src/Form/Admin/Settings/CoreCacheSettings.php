<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\Form;

class CoreCacheSettings extends Form
{

    protected function initialize()
    {
        $this->setTitle(_text('Cache Settings', 'admin.core_cache'));
        $this->setInfo(_text('[Site Settings Info]', 'admin'));

        $this->addElement([
            'factory'  => 'select',
            'name'     => 'core__default_cache_id',
            'value'    => '1',
            'options'  => _service('core.cache')->getAdapterIdOptions(),
            'label'    => _text('Default Cache Adapter', 'admin.core_cache'),
            'note'     => _text('[Default Cache Adapter Note]', 'admin.core_cache'),
            'required' => true,
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
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel', 'type' => 'button', 'data-cmd' => 'form.cancel',],
        ]);
    }
}