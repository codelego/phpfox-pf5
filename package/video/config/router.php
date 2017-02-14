<?php

return [
    'routes' => [
        'video'       => [
            'route'      => 'video',
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