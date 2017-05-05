<?php

namespace Neutron\Blog\Form;

use Neutron\Blog\Validator\EditBlogCategoryValidator;
use Phpfox\Form\ButtonField;
use Phpfox\Form\Form;

class AddBlogCategory extends Form
{
    protected $validatorClass = EditBlogCategoryValidator::class;

    public function initialize()
    {
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'name',
            'label'      => _text('Category Name'),
            'required'   => true,
            'value'      => '',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
        ]);

        $this->addElement([
            'factory'    => 'textarea',
            'name'       => 'description',
            'label'      => _text('Description'),
            'required'   => false,
            'value'      => '',
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
        ]);
        $this->addElement([
            'factory'    => 'yesno',
            'name'       => 'is_active',
            'label'      => _text('Is Active'),
            'required'   => true,
            'value'      => 0,
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
            new ButtonField([
                'type'       => 'submit',
                'name'       => 'save',
                'label'      => _text('Save Changes'),
                'attributes' => ['class' => 'btn btn-primary'],
            ]),
            new ButtonField([
                'type'       => 'submit',
                'label'      => _text('Cancel'),
                'href'       => _url('admin.blog.category'),
                'attributes' => ['class' => 'btn btn-link'],
            ]),
        ];
    }
}
