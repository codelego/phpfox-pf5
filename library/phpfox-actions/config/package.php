<?php
namespace Phpfox\Action {

    return [
        'services' => [
            'dispatcher'      => [null, Dispatcher::class],
            'request'       => [RequestFactory::class, null],
            'response'      => [ResponseFactory::class, null],
            'response.ajax' => [null, AjaxResponse::class],
            'response.html' => [null, HtmlResponse::class],
        ],
    ];
}
