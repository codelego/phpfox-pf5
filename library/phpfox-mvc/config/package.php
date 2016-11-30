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
            'responder' => [null, Responder::class,],
            'requester' => [null, Requester::class,],
            'app'       => [null, Application::class],
            'views'     => [null, TwigTemplate::class],
            'models'    => [null, GatewayManager::class],
        ],
    ];
}
