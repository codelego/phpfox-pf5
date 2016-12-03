<?php
namespace Phpfox\Mvc {

    return [
        'psr4' => [
            'Phpfox\\Mvc\\' => [
                'library/phpfox-mvc/src',
                'library/phpfox-mvc/test',
            ],
        ],
        'service.map'   => [
            'mvc.dispatch' => [null, MvcDispatch::class],
            'mvc.request'  => [MvcRequestFactory::class, null],
            'mvc.response' => [MvcResponseFactory::class, null],
            'mvc.events'   => [null, MvcEventManager::class],
        ],
    ];
}
