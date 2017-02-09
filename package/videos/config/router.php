<?php

return [
    'routes' => [
        'videos'      => [
            'route'      => 'videos',
            'controller' => 'video.index',
            'action'     => 'index',
        ],
        'video'       => [
            'route'      => 'video/*',
            'controller' => 'video.index',
            'action'     => 'index',
        ],
        'video.embed' => [
            'route'  => 'embed',
            'action' => 'embed',
        ],
    ],
];