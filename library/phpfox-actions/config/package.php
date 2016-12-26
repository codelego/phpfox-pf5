<?php
namespace Phpfox\Action {

    return [
        'services' => [
            'mvc.dispatch' => [null, ActionDispatch::class],
            'mvc.request'  => [ActionRequestFactory::class, null],
            'mvc.response' => [ActionResponseFactory::class, null],
        ],
    ];
}
