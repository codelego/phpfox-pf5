<?php

namespace Neutron\Blog\Validator;

use Phpfox\Validate\Validator;

class EditBlogCategoryValidator extends Validator
{
    protected function initialize()
    {
        $this->configure([
            'name'      => [
                'label'    => 'Category Name',
                'required' => [
                    'message' => _text('Category Name is required'),
                ],
                'string'   => [
                    'message' => _text('Category Name is too long'),
                    'max'     => 40,
                ],
                'unique'   => [
                    'primary_key' => 'category_id',
                    'unique_key'  => 'name',
                    'table'       => ':blog_category',
                    'message'     => 'Category Name is duplicated',
                ],
            ],
            'is_active' => [
                'required' => ['message' => 'Is Active is required'],
            ],
        ]);
    }
}