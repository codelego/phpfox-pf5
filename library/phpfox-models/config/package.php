<?php
namespace Phpfox\Model;

return [
    'psr4'        => [
        'Phpfox\\Model\\' => [
            'library/phpfox-models/src',
            'library/phpfox-models/test',
        ],
    ],
    'service.map' => [
        'models'         => [null, GatewayManager::class],
    ],
];