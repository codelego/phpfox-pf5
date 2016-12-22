<?php
namespace Phpfox\Mvc {

    return [
        'services' => [
            'mvc.dispatch' => [null, MvcDispatch::class],
            'mvc.request'  => [MvcRequestFactory::class, null],
            'mvc.response' => [MvcResponseFactory::class, null],
        ],
    ];
}
