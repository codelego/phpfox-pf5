<?php

namespace Neutron\Core\Form\Admin\LayoutComponent;

use Phpfox\Form\Form;

class AddLayoutComponent extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Layout Component', ''));
        $this->setInfo(_text('[Add Layout Component Info]', ''));
        $this->setAction(_url('#'));

        /** start elements **/


        /** element `component_id` **/
        $this->addElement([
            'name'      => 'component_id',
            'factory'   => 'text',
            'label'     => _text('Component Id', null),
            'note'      => _text('[Component Id Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `component_name` **/
        $this->addElement([
            'name'      => 'component_name',
            'factory'   => 'text',
            'label'     => _text('Component Name', null),
            'note'      => _text('[Component Name Note]', null),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `component_class` **/
        $this->addElement([
            'name'      => 'component_class',
            'factory'   => 'text',
            'label'     => _text('Component Class', null),
            'note'      => _text('[Component Class Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);

        /** element `form_name` **/
        $this->addElement([
            'name'      => 'form_name',
            'factory'   => 'text',
            'label'     => _text('Form Name', null),
            'note'      => _text('[Form Name Note]', null),
            'value'     => 'none',
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `package_id` **/
        $this->addElement([
            'name'      => 'package_id',
            'factory'   => 'select',
            'label'     => _text('Package Id', null),
            'note'      => _text('[Package Id Note]', null),
            'value'     => 'core',
            'options'   => _get('core.packages')->getPackageIdOptions(),
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `is_active` **/
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', null),
            'note'     => _text('[Is Active Note]', null),
            'value'    => '1',
            'required' => true,
        ]);

        /** element `ordering` **/
        $this->addElement([
            'name'      => 'ordering',
            'factory'   => 'text',
            'label'     => _text('Ordering', null),
            'note'      => _text('[Ordering Note]', null),
            'value'     => '1',
            'maxlength' => 255,
            'required'  => true,
        ]);

        /** element `description` **/
        $this->addElement([
            'name'      => 'description',
            'factory'   => 'textarea',
            'label'     => _text('Description', null),
            'note'      => _text('[Description Note]', null),
            'maxlength' => 255,
            'required'  => false,
        ]);
        /** end elements **/

        $this->addButton([
            'factory'    => 'button',
            'name'       => 'save',
            'label'      => _text('Submit'),
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
