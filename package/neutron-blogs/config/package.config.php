<?php
namespace Neutron\Blog;

return [
    'services' => [
        'blog.callback' => [null, Service\EventListener::class],
    ],
];