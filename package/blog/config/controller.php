<?php

namespace Neutron\Blog\Controller;

return [
    'blog.profile'        => ProfileController::class,
    'blog.admin-category' => AdminCategoryController::class,
    'blog.index'          => IndexController::class,
    'blog.post'           => BlogPostController::class,
    'blog.admin-post'     => AdminPostController::class,
];