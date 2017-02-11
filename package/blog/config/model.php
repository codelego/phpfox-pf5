<?php

namespace Neutron\Blog\Model;

return [
    'blog_post'     => [
        'table_factory',
        ':blog_post',
        Post::class,
        'package/blog/config/model/blog_post.php',
    ],
    'blog_category' => [
        'table_factory',
        ':blog_category',
        Category::class,
        'package/blog/config/model/blog_category.php',
    ],
];