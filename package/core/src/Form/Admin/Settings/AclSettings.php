<?php

namespace Neutron\Core\Form\Admin\Settings;


use Phpfox\Form\Form;

class AclSettings extends Form
{
    protected function initialize()
    {
        $this->setTitle(_text('User Group Settings', 'admin'));
        $this->setInfo(_text('[User Group Settings Note]', 'admin'));

        /** start elements */

        $this->addElement([
            'name'     => 'core__storage_quota',
            'factory'  => 'text',
            'label'    => _text('Storage Quota', 'admin.core_acl'),
            'note'     => _text('[Storage Quota Note]', 'admin.core_acl'),
            'required' => true,
        ]);
        /** end elements */

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