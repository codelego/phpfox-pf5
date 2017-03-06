<?php

namespace Neutron\Blog\Form;


use Phpfox\Form\Button;
use Phpfox\Form\Form;

class AddBlogPost extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'title',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Title'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'content',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Content'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
            'label'      => _text('Description'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'select',
            'name'       => 'category_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Category Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'publish_at',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Publish At'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'privacy_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Privacy Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'status_id',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
            'label'      => _text('Status Id'),
            'required'   => true,
        ]);
        $this->addElement([
            'factory'    => 'yesno',
            'name'       => 'is_approved',
            'label'      => _text('Is Approved'),
            'required'   => true,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'yesno',
            'name'       => 'is_featured',
            'label'      => _text('Is Featured'),
            'required'   => true,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
        ]);
    }

    public function getButtons()
    {
        return [
            new Button([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Add New Post'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new Button([
                'type'       => 'submit',
                'label'      => _text('Cancel'),
                'href'       => _url('admin.blog.category'),
                'attributes' => ['class' => 'btn btn-link'],
            ]),
        ];
    }
}