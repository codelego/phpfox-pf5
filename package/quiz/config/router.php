<?php

return [
    'routes' => [
        'admin.quiz' => [
            'route'      => 'quiz/*',
            'controller' => 'quiz.admin-quiz',
            'action'     => 'index',
            'children'   => [
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'quiz.admin-settings',
                ],
                'manage'   => [
                    'route'      => 'manage(/<action>)',
                    'controller' => 'quiz.admin-quiz',
                ],
            ],
        ],
    ],
];