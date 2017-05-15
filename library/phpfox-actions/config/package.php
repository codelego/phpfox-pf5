<?php

namespace Phpfox\Action {

    return [
        'services' => [
            'dispatcher'               => [null, Dispatcher::class],
            'request'                  => [RequestFactory::class, null],
            'response'                 => [ResponseFactory::class, null],
            'response.ajax'            => [null, JsonResponse::class],
            'response.html'            => [null, HtmlResponse::class],
            'response.partial'         => [null, JsonResponse::class],
            'response.ajax_push_state' => [null, AjaxPushStateResponse::class],
        ],
    ];
}
