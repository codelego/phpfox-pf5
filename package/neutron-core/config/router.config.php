<?php

return [
    'phrases' => [],
    'chains'  => [
        'admincp'         => [
            'route'    => '{admincp}/*',
            'defaults' => [],
        ],
        'rest'            => [
            'route'    => '{rest}/*',
            'defaults' => [],
        ],
        'ajax'            => [
            'route' => '{ajax}/*',
        ],
        'profile:general' => [
            'route'  => '<name>/*',
            'filter' => 'user.callback@filterProfileName',
        ],
        'profile:user'    => [
            'route'    => '{profile}/<name>/*',
            'filter'   => 'user.callback@filterProfileName',
            'defaults' => [
                'controller' => 'user.profile',
                'action'     => 'index',
            ],
        ],
        'profile:pages'   => [
            'route'    => '{pages}/<name>/*',
            'filter'   => 'pages.callback@filterProfileName',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'index',
            ],
        ],
        'profile:groups'  => [
            'route'    => '{groups}/<name>/*',
            'filter'   => 'group.callback@filterProfileName',
            'defaults' => [
            ],
        ],
        'profile:events'  => [
            'route'    => '{events}/<name>/*',
            'filter'   => 'event.callback@filterProfileName',
            'defaults' => [
                'controller' => 'pages.profile',
                'action'     => 'index',
            ],
        ],
    ],
    'routes'  => [
        'home'                        => [
            'route'    => '/',
            'wheres'   => [],
            'defaults' => [
                'controller' => 'core.index',
                'action'     => 'index',
            ],
        ],
        'rest:menus'                  => [
            'route'    => 'menus',
            'method'   => 'GET',
            'group'    => 'rest',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'listing',
            ],
        ],
        'rest:menu.item'              => [
            'route'    => 'menu/<id>',
            'defaults' => [
                'controller' => 'RestfulMenuController',
                'action'     => 'view',
            ],
        ],
        'admincp:core.dashboard'      => [
            'route'    => '{admincp}',
            'defaults' => [
                'controller' => 'core.admin-dashboard',
                'action'     => 'index',
            ],
        ],
        'admincp:core.theme'          => [
            'route'    => '{admincp}/core/theme/<action>?',
            'defaults' => [
                'controller' => 'core.admin-theme',
                'action'     => 'index',
            ],
        ],
        'admincp:core.package'        => [
            'route'    => '{admincp}/core/package/<action>?',
            'defaults' => [
                'controller' => 'core.admin-package',
                'action'     => 'index',
            ],
        ],
        'admincp:core.settings'       => [
            'route'    => '{admincp}/core/settings/<action>?',
            'defaults' => [
                'controller' => 'core.admin-settings',
                'action'     => 'index',
            ],
        ],
        'admincp:core.mail-transport' => [
            'route'    => '{admincp}/core/mail-transport/<action>?',
            'defaults' => [
                'controller' => 'core.admin-mail-transport',
                'action'     => 'index',
            ],
        ],
        'profile:index'               => [
            'route'    => '/',
            'defaults' => [
                'action' => 'index',
            ],
        ],
    ],
];