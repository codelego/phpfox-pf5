<?php

namespace Phpfox\Action;

return [
    'services' => [
        'dispatcher'                 => [null, Dispatcher::class],
        'request'                    => [RequestFactory::class, null],
        'response'                   => [ResponseFactory::class, null],
        'response.ajax'              => [null, JsonResponse::class],
        'response.html'              => [null, HtmlResponse::class],
        'response.update_containers' => [null, UpdateContainersResponse::class],
        'response.update_content'    => [null, UpdateContentResponse::class],
    ],
];
