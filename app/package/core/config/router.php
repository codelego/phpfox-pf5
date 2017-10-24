<?php

return [
    'phrases' => [],
    'chains'  => [

    ],
    'routes'  => [
        'admin'                => [
            'route'      => 'admincp/*',
            'controller' => 'core.admin-index',
            'action'     => 'index',
        ],
        'admin.core'           => [
            'route'      => 'core/*',
            'controller' => 'core.admin-index',
            'action'     => 'index',
        ],
        'admin.core.auth'      => [
            'route'      => 'auth/<action>',
            'controller' => 'core.admin-auth',
            'action'     => 'login',
        ],
        'admin.core.profile'   => [
            'route'      => 'profile/<action>',
            'controller' => 'core.admin-profile',
            'action'     => 'index',
        ],
        'admin.core.storage'   => [
            'route'      => 'storage(/<action>)',
            'controller' => 'core.admin-storage',
            'action'     => 'index',
        ],
        'admin.core.session'   => [
            'route'      => 'session(/<action>)',
            'controller' => 'core.admin-session',
            'action'     => 'index',
        ],
        'admin.core.captcha'   => [
            'route'      => 'captcha(/<action>)',
            'controller' => 'core.admin-captcha',
            'action'     => 'index',
        ],
        'admin.core.sms'       => [
            'route'      => 'sms(/<action>)',
            'controller' => 'core.admin-sms',
            'action'     => 'index',
        ],
        'admin.core.package'   => [
            'route'      => 'package(/<action>)',
            'controller' => 'core.admin-package',
            'action'     => 'index',
        ],
        'admin.core.theme'     => [
            'route'      => 'theme(/<action>)',
            'controller' => 'core.admin-theme',
            'action'     => 'index',
        ],
        'admin.core.component' => [
            'route'      => 'component(/<action>)',
            'controller' => 'core.admin-component',
        ],
        'admin.core.layout'    => [
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
                'container' => [
                    'route'      => 'container(/<action>)',
                    'controller' => 'core.admin-layout-container',
                ],
            ],

        ],
        'admin.core.cache'     => [
            'route'      => 'cache(/<action>)',
            'controller' => 'core.admin-cache',
            'action'     => 'index',
        ],
        'admin.core.menu'      => [
            'route'      => 'menu(/<action>)',
            'controller' => 'core.admin-menu',
            'action'     => 'index',
        ],
        'admin.core.log'       => [
            'route'      => 'log(/<action>)',
            'controller' => 'core.admin-log',
            'action'     => 'index',
        ],
        'admin.core.status'    => [
            'route'      => 'status(/<action>)',
            'controller' => 'core.admin-status',
            'action'     => 'overview',
        ],
        'admin.core.i18n'      => [
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
                'message'  => ['route' => 'message(/<action>)',],
            ],
        ],
        'admin.core.mail'      => [
            'route'      => 'mail/*',
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
        'admin.core.settings'  => [
            'route'      => 'settings/*',
            'controller' => 'core.admin-settings',
            'action'     => 'index',
            'children'   => [
                'edit' => [
                    'route'  => 'edit/<form_id>',
                    'action' => 'edit',
                ],
            ],
        ],
        'admin.login'          => [
            'route'      => 'login',
            'controller' => 'core.admin-auth',
            'action'     => 'login',
        ],
        'api'                  => [
            'route' => 'api/*',
        ],
        'ajax'                 => [
            'route' => 'ajax/*',
        ],
        'ajax.i18n'            => [
            'route'      => 'i18n/<action>',
            'controller' => 'core.ajax-i18n',
        ],
        'home'                 => [
            'route'      => '/',
            'controller' => 'core.index',
            'action'     => 'index',
        ],
        'offline'              => [
            'route'      => 'offline',
            'controller' => 'core.offline',
            'action'     => 'index',
        ],
        'api.menu'             => [
            'route'      => 'menu',
            'controller' => 'MenuApiController',
            'action'     => 'listing',
        ],
        'api.menu.item'        => [
            'route'      => '<id>',
            'controller' => 'MenuApiController',
            'action'     => 'view',
        ],
        'profile.index'        => [
            'route'  => '/',
            'action' => 'index',
        ],
    ],
];