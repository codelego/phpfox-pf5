<?php

namespace Phpfox\Navigation;

return [
    'navigation.decorators' => [
        'navbar' => NavbarDecorator::class,
        'nav'    => NavDecorator::class,
    ],
    'services'              => [
        'navigation' => [null, NavigationManager::class],
    ],
];