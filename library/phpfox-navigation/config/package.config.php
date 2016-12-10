<?php

namespace Phpfox\Navigation;

return [
    'navigation.decorators' => [
        'navbar' => NavbarNavDecorator::class,
        'tab'    => TabNavDecorator::class,
    ],
    'services'           => [
        'navigation' => [null, NavigationManager::class],
    ],
];