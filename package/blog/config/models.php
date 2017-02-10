<?php

namespace Neutron\Blog\Model;

return [
    'blog_post'     => [
        'table_factory',
        ':blog_post',
        Post::class,
        'blog/config/.meta.blog_post.php',
    ],
    'blog_category' => [
        'table_factory',
        ':blog_category',
        Category::class,
        'blog/config/.meta.blog_category.php',
    ],
];