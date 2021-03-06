<?php

namespace Neutron\Dev\Form\Admin\DevActionMeta;

use Phpfox\Form\Form;

class FilterDevActionMeta extends Form
{

    public function initialize()
    {

        $this->setMethod('get');
        /** start elements **/

        // skip element `meta_id` #identity

        // element `table_name`
        $this->addElement([
            'name'        => 'table_name',
            'factory'     => 'text',
            'placeholder' => _text('Table Name', null),
            'maxlength'   => 255,
        ]);

        // element `package_id`
        $this->addElement([
            'name'        => 'package_id',
            'factory'     => 'select',
            'placeholder' => _text('Package', null),
            'options'     => \Phpfox::get('core.packages')->getPackageIdOptions(),
            'maxlength'   => 255,
        ]);

        // element `action_type`
        $this->addElement([
            'name'        => 'action_type',
            'factory'     => 'select',
            'placeholder' => _text('Action Type', null),
            'maxlength'   => 255,
            'options'     => [
                ['value' => 'admin_add', 'label' => 'admin_add'],
                ['value' => 'admin_edit', 'label' => 'admin_edit'],
                ['value' => 'admin_delete', 'label' => 'admin_delete'],
                ['value' => 'admin_filter', 'label' => 'admin_filter'],
                ['value' => 'model_class', 'label' => 'model_class'],
                ['value' => 'admin_acl_settings', 'label' => 'Acl Settings'],
                ['value' => 'admin_site_settings', 'label' => 'Site Settings'],
            ],
        ]);

        $this->addButton([
            'name'       => 'search',
            'factory'    => 'button',
            'label'      => _text('Search'),
            'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
        ]);

        /** end elements **/
    }
}
