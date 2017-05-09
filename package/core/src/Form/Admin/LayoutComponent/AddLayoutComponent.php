<?php

namespace Neutron\Core\Form\Admin\LayoutComponent;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddLayoutComponent extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Layout Component', 'admin.core_layout'));
        $this->setInfo(_text('[Add Layout Component Info]', 'admin.core_layout'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `component_id`
        $this->addElement([
            'name'       => 'component_id',
            'factory'    => 'text',
            'label'      => _text('Component Id', 'admin.core_layout'),
            'note'       => _text('[Component Id Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `component_name`
        $this->addElement([
            'name'       => 'component_name',
            'factory'    => 'text',
            'label'      => _text('Component Name', 'admin.core_layout'),
            'note'       => _text('[Component Name Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `component_class`
        $this->addElement([
            'name'       => 'component_class',
            'factory'    => 'text',
            'label'      => _text('Component Class', 'admin.core_layout'),
            'note'       => _text('[Component Class Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
        ]);

        // element `form_name`
        $this->addElement([
            'name'       => 'form_name',
            'factory'    => 'text',
            'label'      => _text('Form Name', 'admin.core_layout'),
            'note'       => _text('[Form Name Note]', 'admin.core_layout'),
            'value'      => 'none',
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `package_id`
        $this->addElement([
            'name'       => 'package_id',
            'factory'    => 'select',
            'label'      => _text('Package Id', 'admin.core_layout'),
            'note'       => _text('[Package Id Note]', 'admin.core_layout'),
            'value'      => 'core',
            'options'    => _service('core.packages')->getPackageIdOptions(),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `is_active`
        $this->addElement([
            'name'     => 'is_active',
            'factory'  => 'yesno',
            'label'    => _text('Is Active', 'admin.core_layout'),
            'note'     => _text('[Is Active Note]', 'admin.core_layout'),
            'value'    => '1',
            'required' => true,
        ]);

        // element `sort_order`
        $this->addElement([
            'name'       => 'sort_order',
            'factory'    => 'text',
            'label'      => _text('Sort Order', 'admin.core_layout'),
            'note'       => _text('[Sort Order Note]', 'admin.core_layout'),
            'value'      => '1',
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `description`
        $this->addElement([
            'name'       => 'description',
            'factory'    => 'textarea',
            'label'      => _text('Description', 'admin.core_layout'),
            'note'       => _text('[Description Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => false,
        ]);

        /** end elements **/
    }


    public function getButtons()
    {

        /** start buttons **/
        return [
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'button',
                'name'       => 'cancel',
                'href'       => '#',
                'data-cmd'   => 'form.cancel',
                'label'      => _text('Cancel'),
                'attributes' => ['class' => 'btn btn-link cancel'],
            ]),
        ];
        /** end buttons **/
    }
}
