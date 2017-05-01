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
                    'route'  => 'design/<id>',
                    'action' => 'design',
                ],
                'edit-block'   => [
                    'route'  => 'edit-block/<id>',
                    'action' => 'edit-block',
                ],
                'add-block'    => [
                    'route'  => 'add-block',
                    'action' => 'add-block',
                ],
                'manage-component'      => [
                    'route'  => 'manage-component',
                    'action' => 'manage-component',
                ],
                'add-component'  => [
                    'route'  => 'add-component',
                    'action' => 'add-component',
                ],
                'edit-component' => [
                    'route'  => 'edit-component/<id>',
                    'action' => 'edit-component',
                ],
                'manage-theme'   => [
                    'route'  => 'manage-theme',
                    'action' => 'manage-theme',
                ],
                'edit-theme'     => [
                    'route'  => 'edit-theme/<id>',
                    'action' => 'edit-theme',
                ],
                'debug-theme'    => [
                    'route'  => 'debug-theme/<id>',
                    'action' => 'debug-theme',
                ],
                'debug'          => [
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
                'add-adapter'     => [
                    'route'  => 'add-adapter',
                    'action' => 'add-adapter',
                ],
                'edit-adapter'    => [
                    'route'  => 'edit-adapter/<id>',
                    'action' => 'edit-adapter',
                ],
                'manage-template' => [
                    'route'  => 'manage-template',
                    'action' => 'manage-template',
                ],
                'add-template'    => [
                    'route'  => 'add-template',
                    'action' => 'add-template',
                ],
                'edit-template'   => [
                    'route'  => 'edit-template/<id>',
                    'action' => 'edit-template',
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