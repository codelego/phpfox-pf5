<?php

namespace Phpfox\Navigation;

return [
    'navigation.decorators' => [
        'navbar'  => NavbarDecorator::class,
        'nav'     => NavDecorator::class,
        'aside'   => AsideDecorator::class,
        'toolbar' => ToolbarDecorator::class,
        'edit'    => EditDecorator::class,
    ],
    'services'              => [
        'navigation' => [null, NavigationManager::class],
        'breadcrumb' => [null, Breadcrumb::class,],
    ],
];