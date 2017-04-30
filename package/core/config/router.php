<?php

return [
    'phrases' => [],
    'chains'  => [

    ],
    'routes'  => [
        'admin'                    => [
            'route'      => 'admincp/*',
            'controller' => 'core.admin-index',
            'action'     => 'index',
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
        'admin.core.storage'       => [
            'route'      => 'core/storage/*',
            'controller' => 'core.admin-storage',
            'action'     => 'index',
            'children'   => [
                'edit'     => ['route' => 'edit/<id>', 'action' => 'edit'],
                'transfer' => [
                    'route'  => 'transfer/<id>',
                    'action' => 'transfer',
                ],
                'add'      => ['route' => 'add', 'action' => 'add'],
                'delete'   => ['route' => 'delete', 'action' => 'delete'],
            ],
        ],
        'admin.core.package'       => [
            'route'      => 'core/package/*',
            'controller' => 'core.admin-package',
            'action'     => 'index',
            'children'   => [
                'add' => [
                    'route'    => 'add',
                    'defaults' => ['action' => 'add'],
                ],
            ],
        ],
        'admin.core.layout'        => [
            'route'      => 'core/layout/*',
            'controller' => 'core.admin-layout',
            'action'     => 'index',
            'children'   => [
                'edit'           => [
                    'route'  => 'edit/<id>',
                    'action' => 'edit',
                ],
                'add'            => [
                    'route'  => 'add',
                    'action' => 'add',
                ],
                'design'         => [
                    'route'  => 'element/<id>',
                    'action' => 'element',
                ],
                'edit-element'   => [
                    'route'  => 'edit-element/<id>',
                    'action' => 'edit-element',
                ],
                'component'      => [
                    'route'  => 'component',
                    'action' => 'component',
                ],
                'add-component'  => [
                    'route'  => 'add-component',
                    'action' => 'add-component',
                ],
                'edit-component' => [
                    'route'  => 'edit-component/<id>',
                    'action' => 'edit-component',
                ],
                'debug'          => [
                    'route'  => 'debug/<id>',
                    'action' => 'debug',
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
            'route'      => 'core/i18n/*',
            'controller' => 'core.admin-i18n',
            'action'     => 'index',
            'children'   => [
                'add-phrase' => [
                    'route'  => 'add-phrase',
                    'action' => 'add-phrase',
                ],
                'languages'  => [
                    'route'  => 'languages',
                    'action' => 'index',
                ],
                'phrases'    => [
                    'route'  => 'phrases',
                    'action' => 'phrases',
                ],
            ],
        ],
        'admin.core.mail'          => [
            'route'      => 'core/mail/*',
            'controller' => 'core.admin-mail',
            'action'     => 'index',
            'children'   => [
                'transports'    => [
                    'route'  => 'transports',
                    'action' => 'transports',
                ],
                'add-transport' => [
                    'route'  => 'add-transport',
                    'action' => 'add-transport',
                ],
            ],
        ],
        'admin.core.status'        => [
            'route'      => 'core/status/*',
            'controller' => 'core.admin-status',
            'action'     => 'overview',
            'children'   => [
                'health' => [
                    'route'  => 'health-check',
                    'action' => 'health-check',
                ],

                'license'    => [
                    'route'  => 'license',
                    'action' => 'license',
                ],
                'overview'   => [
                    'route'  => 'system-overview',
                    'action' => 'overview',
                ],
                'statistics' => [
                    'route'  => 'site-statistics',
                    'action' => 'statistics',
                ],
            ],
        ],
        'admin.core.settings'      => [
            'route'      => 'core/settings/*',
            'controller' => 'core.admin-settings',
            'children'   => [
                'general' => [
                    'route'  => 'general',
                    'action' => 'index',
                ],
            ],
        ],
        'admin.login'              => [
            'route'      => 'login',
            'controller' => 'core.admin-auth',
            'action'     => 'login',
        ],
        'api'                      => [
            'route' => 'api/*',
        ],
        'ajax'                     => [
            'route' => 'ajax/*',
        ],
        'ajax.i18n'                => [
            'route'      => 'i18n/<action>',
            'controller' => 'core.ajax-i18n',
        ],
        'home'                     => [
            'route'      => '/',
            'controller' => 'core.index',
            'action'     => 'index',
        ],
        'api.menu'                 => [
            'route'      => 'menu',
            'controller' => 'MenuApiController',
            'action'     => 'listing',
        ],
        'api.menu.item'            => [
            'route'      => '<id>',
            'controller' => 'MenuApiController',
            'action'     => 'view',
        ],
        'profile.index'            => [
            'route'  => '/',
            'action' => 'index',
        ],
    ],
];