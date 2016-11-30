<?php
namespace Phpfox\Model;

return [
    'autoload.psr4' => [
        'Phpfox\\Model\\' => [
            'library/phpfox-models/src',
            'library/phpfox-models/test',
        ],
    ],
    'service.map'   => [
        'gateways' => [null, GatewayManager::class],
    ],
];