<?php
namespace Phpfox\Action {

    return [
        'services' => [
            'mvc.dispatch'      => [null, Dispatcher::class],
            'mvc.request'       => [RequestFactory::class, null],
            'mvc.response'      => [ResponseFactory::class, null],
            'mvc.response.ajax' => [null, AjaxResponse::class],
            'mvc.response.html' => [null, HtmlResponse::class],
        ],
    ];
}
