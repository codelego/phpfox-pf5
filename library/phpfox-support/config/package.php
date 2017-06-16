<?php

namespace Phpfox\Support;

return [
    'services' => [
        'image'                      => [null, InterventionImageManager::class],
        'mvc.events'                 => [null, EventManager::class],
        'context'                    => [null, RequestContext::class],
        'curl'                       => [null, CurlFactory::class],
        'dispatcher'                 => [null, ActionDispatcher::class],
        'request'                    => [RequestFactory::class, null],
        'response'                   => [ResponseFactory::class, null],
        'response.ajax'              => [null, JsonResponse::class],
        'response.html'              => [null, HtmlResponse::class],
        'response.update_containers' => [null, UpdateContainersResponse::class],
        'response.update_content'    => [null, UpdateContentResponse::class],
    ],
];