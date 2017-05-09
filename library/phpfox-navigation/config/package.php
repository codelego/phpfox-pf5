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
    ],
];