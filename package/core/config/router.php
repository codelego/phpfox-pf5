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
        'admin.core'          => [
            'route'      => 'core/*',
            'controller' => 'core.admin-index',
            'action'     => 'index',
        ],
        'admin.core.acl'      => [
            'route'      => 'acl(/<action>)',
            'controller' => 'core.admin-acl',
            'action'     => 'index',
        ],
        'admin.core.storage'  => [
            'route'      => 'storage(/<action>)',
            'controller' => 'core.admin-storage',
            'action'     => 'index',
        ],
        'admin.core.session'  => [
            'route'      => 'session(/<action>)',
            'controller' => 'core.admin-session',
            'action'     => 'index',
        ],
        'admin.core.message'  => [
            'route'      => 'message(/<action>)',
            'controller' => 'core.admin-message',
            'action'     => 'index',
        ],
        'admin.core.captcha'  => [
            'route'      => 'captcha(/<action>)',
            'controller' => 'core.admin-captcha',
            'action'     => 'index',
        ],
        'admin.core.verify'   => [
            'route'      => 'verify(/<action>)',
            'controller' => 'core.admin-verify',
            'action'     => 'index',
        ],
        'admin.core.package'  => [
            'route'      => 'core/package(/<action>)',
            'controller' => 'core.admin-package',
            'action'     => 'index',
        ],
        'admin.core.layout'   => [
            'route'      => 'layout/*',
            'controller' => 'core.admin-layout',
            'action'     => 'index',
            'children'   => [
                'page'      => [
                    'route'      => 'page(/<action>)',
                    'controller' => 'core.admin-layout',
                ],
                'block'     => [
                    'route'      => 'block(/<action>)',
                    'controller' => 'core.admin-layout-block',
                ],
                'theme'     => [
                    'route'      => 'theme(/<action>)',
                    'controller' => 'core.admin-layout-theme',
                    'action'     => 'index',
                ],
                'component' => [
                    'route'      => 'component(/<action>)',
                    'controller' => 'core.admin-layout-component',
                ],
                'container' => [
                    'route'      => 'container(/<action>)',
                    'controller' => 'core.admin-layout-container',
                ],
            ],

        ],
        'admin.core.cache'    => [
            'route'      => 'core/cache(/<action>)',
            'controller' => 'core.admin-cache',
            'action'     => 'index',
        ],
        'admin.core.log'      => [
            'route'      => 'core/log(/<action>)',
            'controller' => 'core.admin-log',
            'action'     => 'index',
        ],
        'admin.core.status'   => [
            'route'      => 'core/status(/<action>)',
            'controller' => 'core.admin-status',
            'action'     => 'overview',
        ],
        'admin.core.i18n'     => [
            'route'      => 'i18n/*',
            'controller' => 'core.admin-i18n-message',
            'action'     => 'index',
            'children'   => [
                'locale'   => [
                    'route'      => 'locale(/<action>)',
                    'controller' => 'core.admin-i18n-locale',
                ],
                'settings' => [
                    'route'      => 'settings(/<action>)',
                    'controller' => 'core.admin-i18n-settings',
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
                'bulk'     => [
                    'route'      => 'bulk(/<action>)',
                    'controller' => 'core.admin-mail-bulk',
                ],
                'adapter'  => ['route' => '(<action>)'],
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