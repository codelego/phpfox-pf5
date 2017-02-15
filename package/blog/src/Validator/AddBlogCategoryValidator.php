<?php

namespace Neutron\Blog\Validator;

use Phpfox\Validate\Validator;

class AddBlogCategoryValidator extends Validator
{
    protected function initialize()
    {
        $this->configure([
            'name'      => [
                'required' => [
                    'message' => _text('Category Name is required'),
                ],
                'string'   => [
                    'message' => _text('Category Name is too long'),
                    'max'     => 40,
                ],
                'callback' => [
                    'callable' => function ($value) {
                        return !\Phpfox::get('blog_category')->hasName($value);
                    },
                    'message'  => 'Category Name is duplicated',
                ],
            ],
            'is_active' => [
                'required' => ['message' => 'Is Active is required'],
            ],
        ]);
    }
}