<?php

namespace Phpfox\Action {

    return [
        'services' => [
            'dispatcher'                 => [null, Dispatcher::class],
            'request'                    => [RequestFactory::class, null],
            'response'                   => [ResponseFactory::class, null],
            'response.ajax'              => [null, JsonResponse::class],
            'response.html'              => [null, HtmlResponse::class],
            'response.partial'           => [null, JsonResponse::class],
            'response.load_full_ajax'    => [null, FullAjaxResponse::class],
            'response.load_content_ajax' => [null, ContentAjaxResponse::class],
        ],
    ];
}
