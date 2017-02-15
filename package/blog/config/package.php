<?php
namespace Neutron\Blog;

return [
    'services'  => [
        'blog.callback' => [null, Service\EventListener::class],
        'blog_category' => [null, Service\BlogCategoryManager::class],
    ],
    'templates' => _view_map(['default' => ['blog' => 'package/blog/view']]),
];