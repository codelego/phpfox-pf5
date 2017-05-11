<?php

return [
    'routes' => [
        'admin.dev' => [
            'route'      => 'core/dev(/<action>)',
            'controller' => 'dev.admin',
            'action'     => 'index',
        ],
    ],
];