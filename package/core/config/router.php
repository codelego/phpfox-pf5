<?php

return [
    'phrases' => [],
    'chains'  => [

    ],
    'routes'  => [
        'admin'                    => [
            'route'    => 'admincp/*',
            'defaults' => [
                'controller' => 'core.admin-index',
                'action'     => 'index',
            ],
        ],
        'admin.core.authorization' => [
            'route'      => 'core/authorizations/*',
            'controller' => 'core.admin-authorization',
            'action'     => 'index',
            'children'   => [
                'edit'     => ['route' => 'edit/<id>', 'action' => 'edit'],
                'settings' => [
                    'route'  => 'settings/<id>',
                    'action' => 'settings',
                ],
                'add'      => ['route' => 'add', 'action' => 'add'],
                'delete'   => ['route' => 'delete', 'action' => 'delete'],
            ],
        ],
        'admin.core.package'       => [
            'route'    => 'core/package/*',
            'defaults' => [
                'controller' => 'core.admin-package',
                'action'     => 'index',
            ],
            'children' => [
                'add' => [
                    'route'    => 'add',
                    'defaults' => ['action' => 'add'],
                ],
            ],
        ],
        'admin.core.theme'         => [
            'route'      => 'core/themes/*',
            'controller' => 'core.admin-theme',
            'action'     => 'index',
            'children'   => [
                'edit'  => [
                    'route'  => 'edit/<id>',
                    'action' => 'edit',
                ],
                'debug' => [
                    'route'  => 'debug/<id>',
                    'action' => 'debug',
                ],
            ],
        ],
        'admin.core.i18n'          => [
            'route'    => 'core/i18n/*',
            'defaults' => [
                'controller' => 'core.admin-i18n',
                'action'     => 'index',
            ],
            'children' => [
                'add-phrase' => [
                    'route'    => 'add-phrase',
                    'defaults' => [
                        'action' => 'add-phrase',
                    ],
                ],
                'languages'  => [
                    'route'    => 'languages',
                    'defaults' => [
                        'action' => 'index',
                    ],
                ],
                'phrases'    => [
                    'route'    => 'phrases',
                    'defaults' => [
                        'action' => 'phrases',
                    ],
                ],
            ],
        ],
        'admin.core.mail'          => [
            'route'      => 'core/mail/*',
            'controller' => 'core.admin-mail-transport',
            'action'     => 'index',
        ],
        'admin.core.status'        => [
            'route'    => 'core/status/*',
            'defaults' => [
                'controller' => 'core.admin-status',
                'action'     => 'overview',
            ],
            'children' => [
                'health' => [
                    'route'    => 'health-check',
                    'defaults' => [
                        'action' => 'health-check',
                    ],
                ],

                'license'    => [
                    'route'    => 'license',
                    'defaults' => [
                        'action' => 'license',
                    ],
                ],
                'overview'   => [
                    'route'    => 'system-overview',
                    'defaults' => [
                        'action' => 'overview',
                    ],
                ],
                'statistics' => [
                    'route'    => 'site-statistics',
                    'defaults' => [
                        'action' => 'statistics',
                    ],
                ],
            ],
        ],
        'admin.core.settings'      => [
            'route'    => 'core/settings/*',
            'defaults' => [
                'controller' => 'core.admin-settings',
            ],
            'children' => [
                'general' => [
                    'route'    => 'general',
                    'defaults' => [
                        'action' => 'index',
                    ],
                ],
            ],
        ],
        'admin.login'              => [
            'route'    => 'login',
            'defaults' => [
                'controller' => 'core.admin-auth',
                'action'     => 'login',
            ],
        ],
        'api'                      => [
            'route' => 'api/*',
        ],
        'ajax'                     => [
            'route' => 'ajax/*',
        ],
        'ajax.i18n'                => [
            'route'    => 'i18n/<action>',
            'defaults' => ['controller' => 'core.ajax-i18n'],
        ],
        'home'                     => [
            'route'    => '/',
            'defaults' => [
                'controller' => 'core.index',
                'action'     => 'index',
            ],
        ],
        'api.menu'                 => [
            'route'    => 'menu',
            'defaults' => [
                'controller' => 'MenuApiController',
                'action'     => 'listing',
            ],
        ],
        'api.menu.item'            => [
            'route'    => '<id>',
            'defaults' => [
                'controller' => 'MenuApiController',
                'action'     => 'view',
            ],
        ],
        'profile.index'            => [
            'route'    => '/',
            'defaults' => [
                'action' => 'index',
            ],
        ],
    ],
];