<?php
namespace Neutron\Blog\Form;

use Phpfox\Form\Form;

class EditBlogCategory extends Form
{
    public function initialize()
    {
        $this->addElement([
            'factory'    => 'yesno',
            'name'       => 'is_active',
            'label'      => _text('Is Active'),
            'required'   => true,
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_TITLE_LENGTH,
                    'class'     => 'form-control',
                ],
        ]);
        $this->addElement([
            'factory'    => 'text',
            'name'       => 'name',
            'label'      => _text('Name'),
            'required'   => true,
            'value'      => 1,
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
            'value'      => 1,
            'attributes' =>
                [
                    'maxlength' => PHPFOX_DESC_LENGTH,
                    'class'     => 'form-control',
                    'rows'      => PHPFOX_DESC_ROWS,
                ],
        ]);
    }
}
