<?php

namespace Neutron\Core\Form\Admin\StorageDriver;

use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddStorageDriver extends Form
{

    public function initialize()
    {

        $this->setTitle(_text('Add Storage Driver', 'admin.core_layout'));
        $this->setInfo(_text('[Add Storage Driver Info]', 'admin.core_layout'));
        $this->setAction(_url('#'));

        /** start elements **/


        // element `driver_id`
        $this->addElement([
            'name'       => 'driver_id',
            'factory'    => 'text',
            'label'      => _text('Driver Id', 'admin.core_layout'),
            'note'       => _text('[Driver Id Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `driver_name`
        $this->addElement([
            'name'       => 'driver_name',
            'factory'    => 'text',
            'label'      => _text('Driver Name', 'admin.core_layout'),
            'note'       => _text('[Driver Name Note]', 'admin.core_layout'),
            'attributes' =>
                [
                    'maxlength' => 255,
                    'class'     => 'form-control',
                ],
            'required'   => true,
        ]);

        // element `form_name`
        $this->addElement([
            'name'       => 'form_name',
            'factory'    => 'text',
            'label'      => _text('Form Name', 'admin.core_layout'),
            'note'       => _text('[Form Name Note]', 'admin.core_layout'),
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

        // element `driver_class`
        $this->addElement([
            'name'       => 'driver_class',
            'factory'    => 'text',
            'label'      => _text('Driver Class', 'admin.core_layout'),
            'note'       => _text('[Driver Class Note]', 'admin.core_layout'),
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
                'name'       => 'save',
                'label'      => _text('Submit'),
                'attributes' => ['class' => 'btn btn-primary', 'type' => 'submit',],
            ]),
            new ButtonField([

                'name' => 'cancel',
                'href' => _url('admin.core.storage.adapter'),

                'label'      => _text('Cancel'),
                'attributes' => [
                    'class'    => 'btn btn-link cancel',
                    'type'     => 'button',
                    'data-cmd' => 'form.cancel',
                ],
            ]),
        ];
        /** end buttons **/
    }
}
