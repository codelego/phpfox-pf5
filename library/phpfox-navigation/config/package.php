<?php

namespace Phpfox\Navigation;

return [
    'navigation.decorators' => [
        'navbar'  => NavbarDecorator::class,
        'nav'     => NavDecorator::class,
        'aside'   => AsideDecorator::class,
        'toolbar' => ToolbarDecorator::class,
    ],
    'services'              => [
        'navigation'           => [null, NavigationManager::class],
        'menu.main.primary'    => [NavigationFactory::class, 'main'],
        'menu.main.secondary'  => [NavigationFactory::class, null],
        'menu.main.mini'       => [NavigationFactory::class, 'main.mini'],
        'menu.admin.primary'   => [NavigationFactory::class, 'admin'],
        'menu.admin.secondary' => [NavigationFactory::class, null],
    ],
];