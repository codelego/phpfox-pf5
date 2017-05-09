<?php

return [
    'phrases' => [],
    'chains'  => [

    ],
    'routes'  => [
        'admin'               => [
            'route'      => 'admincp/*',
            'controller' => 'core.admin-index',
            'action'     => 'index',
        ],
        'admin.core.acl'      => [
            'route'      => 'core/acl/*',
            'controller' => 'core.admin-authorization',
            'action'     => 'index',
            'children'   => [
                'role' => ['route' => '<action>'],
            ],
        ],
        'admin.core.storage'  => [
            'route'      => 'core/storage/*',
            'controller' => 'core.admin-storage-adapter',
            'action'     => 'index',
            'children'   => [
                'driver'  => ['route' => 'driver(/<action>)', 'controller' => 'core.admin-storage-driver'],
                'adapter' => ['route' => 'adapter(/<action>)'],
            ],
        ],
        'admin.core.package'  => [
            'route'      => 'core/package/*',
            'controller' => 'core.admin-package',
            'action'     => 'index',
            'children'   => [
                '*' => [
                    'route' => '<action>',
                ],
            ],
        ],
        'admin.core.layout'   => [
            'route'      => 'core/layout/*',
            'controller' => 'core.admin-layout',
            'action'     => 'index',
            'children'   => [
                'component' => [
                    'route'      => 'component(/<action>)',
                    'controller' => 'core.admin-layout-component',
                ],
                'theme'     => [
                    'route'      => 'theme(/<action>)',
                    'controller' => 'core.admin-layout-theme',
                ],
                'block'     => [
                    'route'      => 'block(/<action>)',
                    'controller' => 'core.admin-layout-block',
                ],
                '*'         => [
                    'route' => '<action>',
                ],
            ],
        ],
        'admin.core.rad'      => [
            'route'      => 'core/rad(/<action>)',
            'controller' => 'core.admin-rad',
            'action'     => 'index',
        ],
        'admin.core.i18n'     => [
            'route'      => 'core/i18n/*',
            'controller' => 'core.admin-i18n-message',
            'action'     => 'index',
            'children'   => [
                'language' => [
                    'route'      => 'language(/<action>)',
                    'controller' => 'core.admin-i18n-language',
                ],
                'timezone' => [
                    'route'      => 'timezone(/<action>)',
                    'controller' => 'core.admin-i18n-timezone',
                ],
                'currency' => [
                    'route'      => 'currency(/<action>)',
                    'controller' => 'core.admin-i18n-currency',
                ],
                'message'  => ['route' => '<action>',],
            ],
        ],
        'admin.core.mail'     => [
            'route'      => 'core/mail/*',
            'controller' => 'core.admin-mail',
            'action'     => 'index',
            'children'   => [
                'template' => [
                    'route'      => 'template(/<action>)',
                    'controller' => 'core.admin-mail-template',
                ],
                'driver'   => [
                    'route'      => 'driver(/<action>)',
                    'controller' => 'core.admin-mail-driver',
                ],
                'bulk'     => [
                    'route'      => 'bulk(/<action>)',
                    'controller' => 'core.admin-mail-bulk',
                ],
                'adapter'  => ['route' => 'adapter(/<action>)'],
            ],
        ],
        'admin.core.status'   => [
            'route'      => 'core/status/*',
            'controller' => 'core.admin-status',
            'action'     => 'overview',
            'children'   => [
                '*' => [
                    'route' => '<action>',
                ],
            ],
        ],
        'admin.core.settings' => [
            'route'      => 'core/settings/*',
            'controller' => 'core.admin-settings',
            'action'     => 'index',
            'children'   => [
                'edit' => [
                    'route'  => 'edit/<setting_group>',
                    'action' => 'edit',
                ],
            ],
        ],
        'admin.login'         => [
            'route'      => 'login',
            'controller' => 'core.admin-auth',
            'action'     => 'login',
        ],
        'api'                 => [
            'route' => 'api/*',
        ],
        'ajax'                => [
            'route' => 'ajax/*',
        ],
        'ajax.i18n'           => [
            'route'      => 'i18n/<action>',
            'controller' => 'core.ajax-i18n',
        ],
        'home'                => [
            'route'      => '/',
            'controller' => 'core.index',
            'action'     => 'index',
        ],
        'api.menu'            => [
            'route'      => 'menu',
            'controller' => 'MenuApiController',
            'action'     => 'listing',
        ],
        'api.menu.item'       => [
            'route'      => '<id>',
            'controller' => 'MenuApiController',
            'action'     => 'view',
        ],
        'profile.index'       => [
            'route'  => '/',
            'action' => 'index',
        ],
    ],
];