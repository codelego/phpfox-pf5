<?php

namespace Phpfox\Navigation;

return [
    'navigation.decorators' => [
        'navbar' => NavbarNavDecorator::class,
        'tab'    => TabNavDecorator::class,
    ],
    'service.map'           => [
        'navigation' => [null, NavigationManager::class],
    ],
];