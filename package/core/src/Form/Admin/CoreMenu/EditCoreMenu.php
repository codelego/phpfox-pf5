<?php

namespace Neutron\Core\Form\Admin\CoreMenu;

use Phpfox\Form\Form;

class EditCoreMenu extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Edit Core Menu', ''));
        $this->setInfo(_text('[Edit Core Menu Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/

        // skip element `id` #identity

        // element `ordering`
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', null),
            'note'      => _text('[Ordering Note]', null),
            'value'     => '100',
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `menu`
        $this->addElement([
            'name'      => 'menu',
            'factory'   => 'text',
            'label'     => _text('Menu', null),
            'note'      => _text('[Menu Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `name`
        $this->addElement([
            'name'      => 'name',
            'factory'   => 'text',
            'label'     => _text('Name', null),
            'note'      => _text('[Name Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `parent_name`
        $this->addElement([
            'name'      => 'parent_name',
            'factory'   => 'text',
            'label'     => _text('Parent Name', null),
            'note'      => _text('[Parent Name Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `package_id`
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', null),
            'note'      => _text('[Package Id Note]', null),
            'options'   => _get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `label`
        $this->addElement([
            'name'      => 'label',
            'factory'   => 'text',
            'label'     => _text('Label', null),
            'note'      => _text('[Label Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `route`
        $this->addElement([
            'name'      => 'route',
            'factory'   => 'text',
            'label'     => _text('Route', null),
            'note'      => _text('[Route Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);
        // skip element `params` #skips

        // element `extra`
        $this->addElement([
            'name'      => 'extra',
            'factory'   => 'text',
            'label'     => _text('Extra', null),
            'note'      => _text('[Extra Note]', null),
            'value'     => '[]',
            'maxlength' => 255,
            'required'  => true,
        ]);

        // element `acl`
        $this->addElement([
            'name'      => 'acl',
            'factory'   => 'text',
            'label'     => _text('Acl', null),
            'note'      => _text('[Acl Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `event`
        $this->addElement([
            'name'      => 'event',
            'factory'   => 'text',
            'label'     => _text('Event', null),
            'note'      => _text('[Event Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `plugin`
        $this->addElement([
            'name'      => 'plugin',
            'factory'   => 'text',
            'label'     => _text('Plugin', null),
            'note'      => _text('[Plugin Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', null),
            'note'     => _text('[Is Active Note]', null),
            'value'    => '1',
            'required' => true,
        ]);

        // element `is_custom`
        $this->addElement([
            'name'     => 'is_custom',
            'factory'  => 'yesno',
            'label'    => _text('Is Custom', null),
            'note'     => _text('[Is Custom Note]', null),
            'value'    => '0',
            'required' => true,
        ]);

        // element `type`
        $this->addElement([
            'name'      => 'type',
            'factory'   => 'text',
            'label'     => _text('Type', null),
            'note'      => _text('[Type Note]', null),
            'value'     => 'route',
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** end elements **/

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
