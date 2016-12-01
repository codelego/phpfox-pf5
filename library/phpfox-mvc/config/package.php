<?php
namespace Phpfox\Mvc {

    return [
        'autoload.psr4' => [
            'Phpfox\\Mvc\\' => [
                'library/phpfox-mvc/src',
                'library/phpfox-mvc/test',
            ],
        ],
        'service.map'   => [
            'mvc.dispatch' => [null, Dispatch::class],
            'mvc.request'  => [RequestFactory::class, null],
            'mvc.response' => [ResponseFactory::class, null],
        ],
    ];
}
