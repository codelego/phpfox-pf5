<?php

namespace Neutron\Announcement\Form;

use Phpfox\Form\Form;

class AddAnnouncement extends Form
{
    protected function initialize()
    {
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'announcement_id',
            'label'      => _text('Announcement Id'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'title',
            'label'      => _text('Title'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'photo_file_id',
            'label'      => _text('Photo File Id'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'label'      => _text('Description'),
            'required'   => false,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'yesno',
            'name'       => 'is_active',
            'label'      => _text('Is Active'),
            'required'   => true,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'type_id',
            'label'      => _text('Type Id'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'content',
            'label'      => _text('Content'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'publish_at',
            'label'      => _text('Publish At'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'expires_at',
            'label'      => _text('Expires At'),
            'required'   => true,
            'attributes' =>
                [
                    'maxlength' => 40,
                    'class'     => 'form-control',
                ],
        ]);
    }
}