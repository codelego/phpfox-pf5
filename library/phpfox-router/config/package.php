<?php

namespace Phpfox\Router {

    return [
        'autoload.psr4'  => [
            'Phpfox\\Router\\' => [
                'library/phpfox-router/src',
                'library/phpfox-router/test',
            ],
        ],
        'router.filters' => [
            '@profile' => [null, ProfileNameFilter::class],
        ],
        'router.phrases' => [],
        'router.routes'  => [],
        'service.map'    => [
            'router'         => [null, RouteManager::class,],
            'router.filters' => [null, FilterContainer::class],
        ],
    ];
}
