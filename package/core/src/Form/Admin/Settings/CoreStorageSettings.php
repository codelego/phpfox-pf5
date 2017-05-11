<?php

namespace Neutron\Core\Form\Admin\Settings;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class CoreStorageSettings extends Form
{

    protected function initialize()
    {
        $this->setTitle(_text('Storage Settings', 'admin'));
        $this->setInfo(_text('[Site Settings Note]', 'admin'));

        $this->addElement([
            'factory'    => 'select',
            'name'       => 'core__default_storage_id',
            'value'      => '1',
            'options'    => _service('core.storage')->getAdapterIdOptions(),
            'label'      => _text('Default Storage', 'admin'),
            'note'       => _text('[Default Storage Note]', 'admin'),
            'attributes' => ['class' => 'form-control'],
            'required'   => true,
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Save Changes'),
            'attributes' => ['class' => 'btn btn-primary','type' => 'submit',],
        ]);

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'cancel',
            'href'       => '#',
            'label'      => _text('Cancel'),
            'attributes' => ['class' => 'btn btn-link cancel','type'=>'button','data-cmd' => 'form.cancel',],
        ]);
    }
}